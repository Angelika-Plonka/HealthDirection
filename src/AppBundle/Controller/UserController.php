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
//        $user = $this->getUser();
        $username = $this->getUser();
        $page = "account";

        return $this->render('profile/main.html.twig', array(
            'username' => $username,
            'page' => $page
        ));
    }

}




//            $form = $this->createFormBuilder()
//                ->add('miasto', TextType::class)
//                ->add('spotkanie', ChoiceType::class, array(
//                    'choices' => array('TAK' => true, 'NIE' => false)
//                ))
//                ->add('Wyślij', SubmitType::class)
//                ->getForm();
//            $formView = $form->createView();


//        /**
//         * @Route("/account", name="account");
//         */
//        public function accountAction(Request $request)
//    {
//
//        $entityManager = $this->getDoctrine()->getManager();
//        $username = $entityManager->getRepository(User::class)->find('username');
//        $username = $entityManager->getRepository(User::class)->find('username');
//
//        $form = $this->createFormBuilder()
//            ->add('waga', TextType::class)
//            ->add('wzrost', TextType::class)
//            ->add('plec', ChoiceType::class, array(
//                'choices' => array('Kobieta' => true, 'Mężczyzna' => false)
//            ))
//            ->add('wiek', IntegerType::class)
//            ->add('talia', IntegerType::class)
//            ->add('biodra', IntegerType::class)
//            ->add('pas', IntegerType::class)
//            ->add('aktywnosc', ChoiceType::class, array(
//                'choices' => array(
//                    'aktywność fizyczna niska' => '1',
//                    'aktywność fizyczna umiarkowana' => '2',
//                    'aktywny tryb życia'   => '3',
//                    'bardzo aktywny tryb życia' => '4',
//                    'wyczynowe uprawianie sportu' => '5',
//                )
//            ))
//            ->add('Wyślij', SubmitType::class)
//            ->getForm();
//
//        $formView = $form->createView();
//
//        return $this->render('profile/main.html.twig', ['username' => $username, 'form' => $formView]);
//
//        }
