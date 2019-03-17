<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class GeneralController extends Controller
{

    /**
     * @Route("/", name="homepage");
     */
    public function home()
    {
        $page = "homepage";
        return $this->render('index.html.twig', array(
            'page' => $page
        ));
    }

    /**
     * @Route("/speedDating", name="speedDating");
     */
    public function speedDating()
    {
        $page = "build";
        return $this->render('speedDating.html.twig', array(
            'page' => $page
        ));
    }

    /**
     * @Route("/portalDescription", name="portalDescription");
     */
    public function portalDescription()
    {
        $page = "portalDescription";
        return $this->render('portalDescription.html.twig', array(
            'page' => $page
        ));
    }


}
