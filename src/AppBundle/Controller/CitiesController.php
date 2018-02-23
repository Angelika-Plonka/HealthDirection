<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Cities;
use AppBundle\Entity\Measurements;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query;

class CitiesController extends Controller
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
        $data = $request->request;
//            echo '<pre>';
//            var_dump($data);
//            echo '</pre>';
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
                $location = new Cities();
                $location->setCity($city);
                $location->setVoivodeship($voivodeship);
                $location->setEagerToMeet($meet);
                $location->setUser($User);
                $entityManager->persist($location);
                $entityManager->flush();
                return $this->redirectToRoute("showUsers");
//                return new Response('<html><body>Twoje pomiary zostały zapisane poprawnie.</body></html>');
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
        $City = $entityManager->getRepository(Cities::class)->findOneBy(['user' => $userId]);

        if($City == null){
            return new Response('<html><body><h3>Nie dodałeś jeszcze miasta</h3><br><br>
                    <h4>Aby to zrobić<a href="/addCity"><button>Kliknij tutaj</button></a></h4><br><br>
                    <h4>Przejście do panelu użytkownika <a href="/account"><button>Klik</button></a></h4>
                    </body></html>');
        }

        $eagerToMeet = [
            0 => "NIE",
            1 => "TAK"
        ];
        $userCity = $City->getCity();
        $friendsCity = $entityManager->getRepository(Cities::class)->findBy(['city' => $userCity]);

        $query = $entityManager->createQuery(
            'SELECT city.city, user.username
                  FROM AppBundle:Cities city
                  LEFT JOIN AppBundle:User user WITH (city.user = user.id)
                  WHERE city.city > :city'
            )->setParameter('city', $userCity);

        $name = $query->getResult();



        return $this->render('profile/showUsersInCity.html.twig', array(
            'page' => $page,
            'friendsInCity' => $friendsCity,
            'eager' => $eagerToMeet,
            'names' => $name
        ));

    }


}