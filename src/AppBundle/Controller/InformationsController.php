<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Informations;
use AppBundle\Entity\Measurements;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query;

class InformationsController extends Controller
{

    /**
     * @Route("/addCity", name="city");
     */
    public function addCityAction(Request $request)
    {
        $page = "addCity";
        $username = $this->getUser();
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $userId = $user->getId();
//        $data = $request->request;

        $errorMsg = false;
        if($request->get('clientId') !== NULL && $request->get('city') !== "" && $request->get('voivodeship') !== ""){
            $city= $request->get('city');
            $voivodeship= $request->get('voivodeship');
            $meet= $request->get('meet');
            $entityManager = $this->getDoctrine()->getManager();
            $User = $entityManager->getRepository(User::class)->findOneBy(['id' => $userId]);

            if ($User === NULL) {
                $errorMsg = 'Niestety nie udało sie wysłać formularza.';
            }
            else{
                $location = new Informations();
                $location->setCity($city);
                $location->setVoivodeship($voivodeship);
                $location->setEagerToWorkout($meet);
                $location->setUser($User);
                $entityManager->persist($location);
                $entityManager->flush();
                return $this->redirectToRoute("showUsersInRegion");
            }
        }

        return $this->render('profile/addCity.html.twig', array(
            'page' => $page,
            'username' => $username,
            'userId' => $userId,
            'err' => $errorMsg
        ));
    }
    /**
     * @Route("/showUsersInCity", name="showUsersInCity");
     */
    public function showUsersInCityAction(Request $request)
    {
        $page = "friends";
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $userId = $user->getId();
        $entityManager = $this->getDoctrine()->getManager();
        $Informations = $entityManager->getRepository(Informations::class)->findOneBy(['user' => $userId]);

        if($Informations == null){
            return new Response('<html><body><h3>Nie dodałeś jeszcze miasta</h3><br><br>
                    <h4>Aby to zrobić<a href="/addCity"><button>Kliknij tutaj</button></a></h4><br><br>
                    <h4>Przejście do panelu użytkownika <a href="/account"><button>Klik</button></a></h4>
                    </body></html>');
        }

        $eagerToMeet = [
            0 => "NIE",
            1 => "TAK"
        ];
        $userCity = $Informations->getCity();
//        $friendsCity = $entityManager->getRepository(Informations::class)->findBy(['city' => $userCity]);

        $db = $this->getDoctrine()->getConnection();
        $query ="
            SELECT informations.city, fos_user.username, informations.eagerToWorkout
            FROM informations
            LEFT JOIN fos_user ON informations.user_id = fos_user.id
            WHERE informations.city = '{$userCity}'
        ";

        $list = $db->query($query)->fetchAll();
//        var_dump($list);

        return $this->render('profile/showUsersInCity.html.twig', array(
            'page' => $page,
            'eager' => $eagerToMeet,
            'names' => $list
        ));
    }

    /**
     * @Route("/showUsersInRegion", name="showUsersInRegion");
     */
    public function showUsersInRegionAction(Request $request)
    {
        $page = "friends";
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $userId = $user->getId();
        $entityManager = $this->getDoctrine()->getManager();
        $Informations = $entityManager->getRepository(Informations::class)->findOneBy(['user' => $userId]);

        if($Informations == null){
            return new Response('<html><body><h3>Nie dodałeś jeszcze miasta i województwa</h3><br><br>
                    <h4>Aby to zrobić<a href="/addCity"><button>Kliknij tutaj</button></a></h4><br><br>
                    <h4>Przejście do panelu użytkownika <a href="/account"><button>Klik</button></a></h4>
                    </body></html>');
        }

        $eagerToMeet = [
            0 => "NIE",
            1 => "TAK"
        ];
        $userVoivodeship = $Informations->getVoivodeship();

        $db = $this->getDoctrine()->getConnection();
        $query ="
            SELECT informations.city, informations.voivodeship, fos_user.username, informations.eagerToWorkout
            FROM informations
            LEFT JOIN fos_user ON informations.user_id = fos_user.id
            WHERE informations.voivodeship = '{$userVoivodeship}'
        ";

        $list = $db->query($query)->fetchAll();
//        var_dump($list);

        return $this->render('profile/showUsersInRegion.html.twig', array(
            'page' => $page,
            'eager' => $eagerToMeet,
            'names' => $list
        ));
    }

}