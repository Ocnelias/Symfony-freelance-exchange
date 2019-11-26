<?php


namespace App\Controller;
use App\Entity\Application;
use App\Entity\Job;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/dashboard")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class DashboardController extends AbstractController
{

    /**
     * @Route("/", name="dashboard_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $jobs_query = $this->getDoctrine()
            ->getRepository(Job::class)
            ->findUserApplications();

        $jobs = $paginator->paginate(
            $jobs_query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        dump($jobs);

        //die();

        return $this->render('dashboard/index.html.twig', [
            'jobs' => $jobs,
        ]);
    }
}