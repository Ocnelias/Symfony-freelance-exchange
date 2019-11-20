<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Job;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    public function indexAction()
    {
        $cats= $this->getDoctrine()
            ->getRepository(Category::class)
            ->getCategoryList();

        $top_projects= $this->getDoctrine()
            ->getRepository(Job::class)
            ->getTopProjects();

        return $this->render('homepage.html.twig', [
            'cats' => $cats,
            'top_projects' => $top_projects,
        ]);
    }

}
