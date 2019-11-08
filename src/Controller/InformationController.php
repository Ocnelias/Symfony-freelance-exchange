<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/info")
 */
class InformationController extends AbstractController
{

    /**
     * @Route("/terms", name="terms", methods={"GET"})
     *
     */
    public function terms()
    {
        echo 'Terms';
    }
}
