<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Measurements;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class MeasurementsController extends Controller
{

    /**
     * @Route("/account/addMeasurements", name="measurements");
     */
    public function addMeasurementsAction(Request $request)
    {
        $page = "addMeasurements";
        $username = $this->getUser();
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $userId = $user->getId();

        $addParameters = new Measurements();
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createFormBuilder()
            ->add('waga', TextType::class, array('label' => 'Wpisz masę ciała [kg]'))
            ->add('wzrost', TextType::class, array('label' => 'Wpisz wzrost [cm]'))
            ->add('wiek', IntegerType::class, array('label' => 'Wpisz wiek'))
            ->add('pas', IntegerType::class, array('label' => 'Obwód w pasie [cm]'))
            ->add('biodra', IntegerType::class, array('label' => 'Obwód bioder [cm]'))
            ->add('talia', IntegerType::class, array('label' => 'Szerokość talii [cm]'))
            ->add('biceps', IntegerType::class, array('label' => 'Obwód bicepsa [cm]'))
            ->add('klata', IntegerType::class, array('label' => 'Obwód klatki piersiowej [cm]'))
            ->add('aktywnosc', ChoiceType::class, array(
                'label' => 'Aktywność fizyczna',
                'choices' => array(
                    'niska - sporadyczna aktywność fizyczna' => '1.4',
                    'aktywność fizyczna umiarkowana' => '1.75',
                    'aktywny tryb życia' => '2',
                    'bardzo aktywny tryb życia' => '2.2',
                    'wyczynowe uprawianie sportu' => '2.4',
                )
            ))
            ->add('plec', ChoiceType::class, array(
                'label' => 'Wybierz płeć',
                'choices' => array('Kobieta' => 'female', 'Mężczyzna' => 'male')
            ))
            ->add('id', HiddenType::class, array(
                    'data' => $userId,
                )
            )
            ->add('Wyślij', SubmitType::class)
            ->getForm();

        $formView = $form->createView();
        $data = $request->request->get('form');
        $errorMsg = FALSE;

//        echo '<pre>';
//        var_dump($data);
//        echo '</pre>';
        if ($request->getMethod() === 'POST') {

            if ($data['id'] === NULL || trim($data['id']) === '') {
                $data['id'] = 0;
            }
            $Person = $entityManager->getRepository(User::class)->find($data['id']);

            if ($Person === NULL) {
                $errorMsg = 'Niestety nie udało sie wysłać formularza.';
            }
            else{
                $addParameters->setAge($data['wiek']);
                $addParameters->setActivity($data['aktywnosc']);
                $addParameters->setBelly($data['pas']);
                $addParameters->setHeight($data['wzrost']);
                $addParameters->setBicep($data['biceps']);
                $addParameters->setSex($data['plec']);
                $addParameters->setWaist($data['talia']);
                $addParameters->setWeight($data['waga']);
                $addParameters->setHips($data['biodra']);
                $addParameters->setChest($data['klata']);
                $addParameters->setPerson($Person);

                $entityManager->persist($addParameters);
                $entityManager->flush();
                return new Response('<html><body><h2>Twoje pomiary zostały zapisane poprawnie.</h2><br><br>
                    <h4>Aby wyświetlić listę swoich pomiarów <a href="/showMeasurements"><button>Kliknij tutaj</button></a></h4><br><br>
                    <h4>Przejście do panelu użytkownika <a href="/account"><button>Kliknij tutaj</button></a></h4>
                    </body></html>');
            }
        }
        return $this->render('profile/addMeasurements.html.twig', array(
            'username' => $username,
            'form' => $formView,
            'page' => $page,
            'err' => $errorMsg
        ));
    }

    /**
     * @Route("/showMeasurements", name="showMeasurements");
     */
    public function showMeasurementsHistoryAction(Request $request)
    {
        $page = "calculate";
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $userId = $user->getId();
        $entityManager = $this->getDoctrine()->getManager();
        $User = $entityManager->getRepository(Measurements::class)->findBy(['person' => $userId], ['dateAdded' => 'DESC'])[0];
        if($User == null){
            return new Response('<html><body><h3>Nie dodałeś jeszcze wymiarów</h3><br><br>
                    <h4>Aby to zrobić<a href="/account/addMeasurements"><button>Kliknij tutaj</button></a></h4><br><br>
                    <h4>Przejście do panelu użytkownika <a href="/account"><button>Klik</button></a></h4>
                    </body></html>');
        }
        $weight = $User->getWeight();
        $height = $User->getHeight();
        $waist = $User->getWaist();
        $hips = $User->getHips();
        $belly = $User->getBelly();
        $sex = $User->getSex();
        $age = $User->getAge();
        $activity = $User->getActivity();

        $newBmi = false;
        if($height !== 0 && $height !==null) {
            $newBmi = round(($weight) / (pow(($height/100), 2)), 2);
            $User->setBmi($newBmi);
            $entityManager->persist($User);
            $entityManager->flush();
        }

        $newWHR = false;
        if($hips !== 0 && $hips !==null) {
            $newWHR = round(($waist / $hips), 2);
            $User->setWhr($newWHR);
            $entityManager->persist($User);
            $entityManager->flush();
        }

        $newFat= false;
        if($waist !== 0 && $waist !==null && $weight !== 0 && $weight !==null){
            $val1 = ((4.15 * $waist)/2.54);
            $val2 = (0.082 * $weight * 2.2);
            $val4 = ($weight * 2.2);
            if($sex == "male"){
                $val3 = ($val1 - $val2 - 98.42);
                $newFat1 = ($val3/$val4)*100;
                $newFat = round($newFat1);
            }else{
                $val3 = ($val1 - $val2 - 76.76);
                $newFat1 = ($val3/$val4)*100;
                $newFat = round($newFat1);
            }
            $User->setFat($newFat);
            $entityManager->persist($User);
            $entityManager->flush();
        }

        $rightKG = false;
        $dailyEnergyRequirements = false;
        if($sex !==null){
            if($sex == "male"){
                $rightKG = ($height - 100 - (($height - 150) / 4));
                $restingMetabolicRate = ((10 * $weight) + (6.25 * $height)-(5 * $age) + 5);
            }else{
                $rightKG = ($height - 100 - (($height - 150) / 2));
                $restingMetabolicRate = ((10 * $weight) + (6.25 * $height)-(5 * $age) - 161);
            }
            $dailyEnergyRequirements = round(($restingMetabolicRate * $activity), 0);
            $User->setRightWeight($rightKG);
            $User->setDailyEnergyRequirements($dailyEnergyRequirements);
            $entityManager->persist($User);
            $entityManager->flush();
        }

        return $this->render('profile/showMeasurementsHistory.html.twig', array(
            'page' => $page,
            'weight' => $weight,
            'height' => $height,
            'waist' => $waist,
            'hips' => $hips,
            'belly' => $belly,
            'bmi' =>$newBmi,
            'whr' => $newWHR,
            'sex' => $sex,
            'fat' => $newFat,
            'rightWeight' => $rightKG,
            'dailyEnergy' => $dailyEnergyRequirements
        ));
    }

}