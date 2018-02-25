<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Cities;
use AppBundle\Entity\Measurements;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserController extends Controller
{

    /**
     * @Route("/", name="homepage");
     */
    public function homeAction(Request $request)
    {
        $page = "homepage";
        return $this->render('index.html.twig', array(
        'page' => $page
    ));
    }

    /**
     * @Route("/portalDescription", name="portalDescription");
     */
    public function portalDescriptionAction(Request $request)
    {
        $page = "portal";
        return $this->render('portalDescription.html.twig', array(
            'page' => $page
        ));
    }

    /**
     * @Route("/about", name="about");
     */
    public function aboutAction(Request $request)
    {
        $page = "about";
        return $this->render('about.html.twig', array(
            'page' => $page
        ));

    }


    /**
     * @Route("/account", name="account");
     */
    public function accountAction(Request $request)
    {
        $user = $this->getUser();
        $page = "account";
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('profile/main.html.twig', array(
            'username' => $user,
            'page' => $page
        ));
    }

    /**
     * @Route("/recipes", name="recipes");
     */
    public function recipesAction(Request $request)
    {

        $page = "recipes";
        $user = false;
        $loadDailyEnergyRequirements = false;
        if($this->getUser()){
            $user = $this->getUser();
            $userId = $user->getId();
            $entityManager = $this->getDoctrine()->getManager();
            if($entityManager->getRepository(Measurements::class)->findBy(['person' => $userId])){
                $Measurement = $entityManager->getRepository(Measurements::class)->findBy(['person' => $userId], ['dateAdded' => 'DESC'])[0];
                $loadDailyEnergyRequirements = $Measurement->getDailyEnergyRequirements();
            }
        }
//        $user = $this->getUser();
//        $username = $this->getUser();
//        $page = "diet";
//        $userId = $user->getId();
//        $loadDailyEnergyRequirements = false;
//        if($userId){
//            $entityManager = $this->getDoctrine()->getManager();
//            if($entityManager->getRepository(Measurements::class)->findBy(['person' => $userId])){
//                $Measurement = $entityManager->getRepository(Measurements::class)->findBy(['person' => $userId], ['dateAdded' => 'DESC'])[0];
//                $loadDailyEnergyRequirements = $Measurement->getDailyEnergyRequirements();
//            }
//        }

//        if (!is_object($user) || !$user instanceof UserInterface) {
//            throw new AccessDeniedException('This user does not have access to this section.');
//        }

        return $this->render('recipes.html.twig', array(
            'username' => $user,
            'page' => $page,
            'dailyEnergy' => $loadDailyEnergyRequirements

        ));
    }

    /**
     * @Route("/customizeDiet", name="customizeDiet");
     */
    public function dietAction(Request $request)
    {
        $page = "diet";
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('profile/customizeDiet.html.twig', array(
            'page' => $page
        ));
    }
}