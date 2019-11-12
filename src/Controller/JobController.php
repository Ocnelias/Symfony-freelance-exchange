<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\Category;
use App\Form\JobType;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/job")
 */
class JobController extends AbstractController
{
    /**
     * @Route("/", name="job_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {


        $jobs_query = $this->getDoctrine()
            ->getRepository(Job::class)
            ->findAll();

        $jobs = $paginator->paginate(
            $jobs_query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );


        return $this->render('job/index.html.twig', [
            'jobs' => $jobs,
        ]);


    }

    /**
     * @Route("/new", name="job_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $job = new Job();
        $job->setUser($this->getUser())->getId();

        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var uploadedFiles $uploadedFiles */
            $uploadedFiles = $form['uploadedFiles']->getData();

            $data =  $form['uploadedFiles']->getData();
           // dump($data); die();

            if ($uploadedFiles) {
                //var_dump($uploadedFiles); die();
                $originalFilename = pathinfo($uploadedFiles->getClientOriginalName(), PATHINFO_FILENAME);

                $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFiles->guessExtension();

                try {
                    $uploadedFiles->move(
                        $this->getParameter('files_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {

                }

                $job->setFiles($newFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($job);
            $entityManager->flush();

            $this->addFlash('success','Your project was created successfully!');

            return $this->redirectToRoute('job_index');
        }

        return $this->render('job/new.html.twig', [
            'job' => $job,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_show", methods={"GET"})
     */
    public function show(Job $job): Response
    {
        return $this->render('job/show.html.twig', [
            'job' => $job,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="job_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Job $job): Response
    {
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('job_index');
        }

        return $this->render('job/edit.html.twig', [
            'job' => $job,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Job $job): Response
    {
        if ($this->isCsrfTokenValid('delete'.$job->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($job);
            $entityManager->flush();
        }

        return $this->redirectToRoute('job_index');
    }


    /**
     * Search action.
     * @Route("/job_search/{search}", name="job_search")
     * @param  Request               $request Request instance
     * @param  string                $search  Search term
     * @return Response|JsonResponse          Response instance
     */
    public function search(Request $request, string $search)
    {
        if (!$request->isXmlHttpRequest()) {
            return $this->render("job/index.html.twig");
        }

        $searchTerm = trim($request->query->get("search", $search));

        $em = $this->getDoctrine()->getManager();
        $results = $em->getRepository(Job::class)->findByTitle($searchTerm);



        return new JsonResponse([
            "html" => $this->renderView("job/search.ajax.twig", ["jobs" => $results]),
            "count" => count($results),
        ]);
    }
}
