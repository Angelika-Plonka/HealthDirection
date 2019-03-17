<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Measurement;
use App\Entity\User;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserController extends Controller
{

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
            if($entityManager->getRepository(Measurement::class)->findBy(['person' => $userId])){
                $Measurement = $entityManager->getRepository(Measurement::class)->findBy(['person' => $userId], ['createdAt' => 'DESC'])[0];
                $loadDailyEnergyRequirements = $Measurement->getDailyEnergyRequirements();
            }
        }

        return $this->render('recipes.html.twig', array(
            'username' => $user,
            'page' => $page,
            'dailyEnergy' => $loadDailyEnergyRequirements

        ));
    }

    /**
     * @Route("/userStories", name="userStories");
     */
    public function userStoriesAction()
    {
        $page = "build";
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('profile/userStories.html.twig', array(
            'page' => $page
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
