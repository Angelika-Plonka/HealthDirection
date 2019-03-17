<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Information;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query;

class InformationController extends Controller
{

    /**
     * @Route("/addInformation", name="information");
     */
    public function addInformation(Request $request)
    {
        $page = "addInformation";
        $username = $this->getUser();
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $userId = $user->getId();

        $errorMsg = false;
        if($request->get('clientId') !== NULL && $request->get('city') !== "" && $request->get('voivodeship') !== ""){
            $city= $request->get('city');
            $voivodeship= $request->get('voivodeship');
            $eagerToWorkout= $request->get('eagerToWorkout');
            $eagerToMeet= $request->get('eagerToMeet');
            $eagerToDate= $request->get('eagerToDate');
            $diet= $request->get('diet');
            $entityManager = $this->getDoctrine()->getManager();

            if ($user === NULL) {
                $errorMsg = 'Niestety nie udało sie wysłać formularza.';
            }
            else{
                $location = new Information();
                $location->setCity($city);
                $location->setVoivodeship($voivodeship);
                $location->setEagerToWorkout($eagerToWorkout);
                $location->setEagerToMeet($eagerToMeet);
                $location->setEagerToDate($eagerToDate);
                $location->setDiet($diet);
                $location->setUser($user);
                $entityManager->persist($location);
                $entityManager->flush();
                return $this->redirectToRoute("showUsersInRegion");
            }
        }

        return $this->render('profile/addInformations.html.twig', array(
            'page' => $page,
            'username' => $username,
            'userId' => $userId,
            'err' => $errorMsg
        ));
    }
    /**
     * @Route("/showUsersInCity", name="showUsersInCity");
     */
    public function showUsersInCity(Request $request)
    {
        $page = "friends";
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $userId = $user->getId();
        $entityManager = $this->getDoctrine()->getManager();
        $Information = $entityManager->getRepository(Information::class)->findOneBy(['user' => $userId]);

        if(null == $Information){
            return new Response('<html><body><h3>Nie dodałeś jeszcze miasta</h3><br><br>
                    <h4>Aby to zrobić<a href="/addInformation"><button>Kliknij tutaj</button></a></h4><br><br>
                    <h4>Przejście do panelu użytkownika <a href="/account"><button>Klik</button></a></h4>
                    </body></html>');
        }

        $userCity = $Information->getCity();

        $db = $this->getDoctrine()->getConnection();
        $query ="
            SELECT information.city, fos_user.username, information.eagerToWorkout, information.eagerToMeet, information.eagerToDate, information.diet
            FROM information
            LEFT JOIN fos_user ON information.user_id = fos_user.id
            WHERE information.city = '{$userCity}'
        ";

        $list = $db->query($query)->fetchAll();

        return $this->render('profile/showUsersInCity.html.twig', array(
            'page' => $page,
            'names' => $list
        ));
    }

    /**
     * @Route("/showUsersInRegion", name="showUsersInRegion");
     */
    public function showUsersInRegion(Request $request)
    {
        $page = "friends";
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $userId = $user->getId();
        $entityManager = $this->getDoctrine()->getManager();
        $Information = $entityManager->getRepository(Information::class)->findOneBy(['user' => $userId]);

        if(null == $Information){
            return new Response('<html><body><h3>Nie dodałeś jeszcze miasta i województwa</h3><br><br>
                    <h4>Aby to zrobić<a href="/addInformation"><button>Kliknij tutaj</button></a></h4><br><br>
                    <h4>Przejście do panelu użytkownika <a href="/account"><button>Klik</button></a></h4>
                    </body></html>');
        }

        $userVoivodeship = $Information->getVoivodeship();

        $db = $this->getDoctrine()->getConnection();
        $query ="
            SELECT information.city, information.voivodeship, fos_user.username, information.eagerToWorkout,information.eagerToMeet, information.eagerToDate, information.diet
            FROM information
            LEFT JOIN fos_user ON information.user_id = fos_user.id
            WHERE information.voivodeship = '{$userVoivodeship}'
        ";

        $list = $db->query($query)->fetchAll();

        return $this->render('profile/showUsersInRegion.html.twig', array(
            'page' => $page,
            'names' => $list
        ));
    }

}
