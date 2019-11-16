<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    public function indexAction()
    {
        $cats= $this->getDoctrine()
            ->getRepository(Category::class)
            ->getCategoryList();

        return $this->render('homepage.html.twig', [

            'cats' => $cats,
        ]);
    }

}
