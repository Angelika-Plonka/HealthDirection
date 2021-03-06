<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Measurement;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class MeasurementController extends Controller
{

    /**
     * @Route("/account/addMeasurement", name="measurement");
     */
    public function addMeasurement(Request $request)
    {
        $page = "addMeasurement";
        $username = $this->getUser();
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $userId = $user->getId();

        $addParameters = new Measurement();
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createFormBuilder()
            ->add('weight', TextType::class, array('label' => 'Wpisz masę ciała [kg]'))
            ->add('height', TextType::class, array('label' => 'Wpisz wzrost [cm]'))
            ->add('age', IntegerType::class, array('label' => 'Wpisz wiek'))
            ->add('belly', IntegerType::class, array('label' => 'Obwód w pasie [cm]'))
            ->add('hips', IntegerType::class, array('label' => 'Obwód bioder [cm]'))
            ->add('waist', IntegerType::class, array('label' => 'Szerokość talii [cm]'))
            ->add('bicep', IntegerType::class, array('label' => 'Obwód bicepsa [cm]'))
            ->add('chest', IntegerType::class, array('label' => 'Obwód klatki piersiowej [cm]'))
            ->add('activity', ChoiceType::class, array(
                'label' => 'Aktywność fizyczna',
                'choices' => array(
                    'niska - sporadyczna aktywność fizyczna' => '1.4',
                    'aktywność fizyczna umiarkowana' => '1.75',
                    'aktywny tryb życia' => '2',
                    'bardzo aktywny tryb życia' => '2.2',
                    'wyczynowe uprawianie sportu' => '2.4',
                )
            ))
            ->add('sex', ChoiceType::class, array(
                'label' => 'Wybierz płeć',
                'choices' => array('Kobieta' => 'female', 'Mężczyzna' => 'male')
            ))
            ->add('id', HiddenType::class, array(
                    'data' => $userId,
                )
            )
            ->add('Wyślij', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        $data = $request->request->get('form');
        $errorMsg = FALSE;

        if ($request->getMethod() === 'POST') {

            if ($data['id'] === NULL || trim($data['id']) === '') {
                $data['id'] = 0;
            }
            $Person = $entityManager->getRepository(User::class)->find($data['id']);

            if ($Person === NULL) {
                $errorMsg = 'Niestety nie udało sie wysłać formularza.';
            }
            else{
                if ($form->isSubmitted() && $form->isValid()) {
                    $addParameters->setAge($data['age']);
                    $addParameters->setActivity($data['activity']);
                    $addParameters->setBelly($data['belly']);
                    $addParameters->setHeight($data['height']);
                    $addParameters->setBicep($data['bicep']);
                    $addParameters->setSex($data['sex']);
                    $addParameters->setWaist($data['waist']);
                    $addParameters->setWeight($data['weight']);
                    $addParameters->setHips($data['hips']);
                    $addParameters->setChest($data['chest']);
                    $addParameters->setPerson($Person);

                    $entityManager->persist($addParameters);
                    $entityManager->flush();
                    $this->addFlash(
                        'notice',
                        'Twoje wymiary zostały zapisane!'
                    );
                    return $this->redirectToRoute('showMeasurements');
                }
                else{
                    $errorMsg = 'Niestety nie udało sie wysłać formularza.';
                }
            }
        }
        return $this->render('profile/addMeasurements.html.twig', array(
            'username' => $username,
            'page' => $page,
            'form' => $form->createView(),
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
        if($entityManager->getRepository(Measurement::class)->findOneBy(['person' => $userId]) == null){
            return $this->redirectToRoute('measurement');
        }
//        $User = $entityManager->getRepository(Measurement::class)->findBy(['person' => $userId], ['dateAdded' => 'DESC'])[0];
        $User = $entityManager->getRepository(Measurement::class)->findBy(['person' => $userId], ['createdAt' => 'DESC'])[0];


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
