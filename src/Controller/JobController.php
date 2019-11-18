<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\Job;
use App\Entity\Category;
use App\Form\JobType;
use App\Form\JobTypeSearch;
use App\Form\ApplicationType;
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
        $search_by_title=$request->query->get('q',null);
        $search_data=$request->query->get('job_type_search',null);
        $search_cats=$request->query->get('search_category','');
        $search_main_cats=$request->query->get('search_main_category','');

        $jobs_query = $this->getDoctrine()
            ->getRepository(Job::class)
            ->findBySearchParams($search_by_title, $search_data, $search_cats, $search_main_cats);

        $jobs = $paginator->paginate(
            $jobs_query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        $job = new Job();
        $form = $this->createForm(JobTypeSearch ::class, $job);

        $cats= $this->getDoctrine()
            ->getRepository(Category::class)
            ->getCategoryList();


        return $this->render('job/index.html.twig', [
            'jobs' => $jobs,
            'form' => $form->createView(),
            'cats' => $cats,
        ]);


    }

    /**
     * @Route("/new", name="job_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SEEKER');

        $job = new Job();
        $job->setUser($this->getUser())->getId();

        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var uploadedFiles $uploadedFiles */
            $uploadedFiles = $form['uploadedFiles']->getData();

            //$attachments = $job->getUploadedFiles();

            //dump($uploadedFiles[0]);

            if ($uploadedFiles) {
                $FileNamesList=[];
                foreach ($uploadedFiles as $uploadedFile) {

                    $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $savedFileName = $originalFilename . '-' . uniqid() . '.' . $uploadedFile->guessExtension();
                    $FileNamesList[] = $savedFileName;

                    try {
                        $uploadedFile->move(
                            $this->getParameter('files_directory'),
                            $savedFileName
                        );
                    } catch (FileException $e) {

                    }
                }
                $job->setFiles(json_encode($FileNamesList));
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
     * @Route("/save_application", name="save_application", methods={"POST"})
     */
    public function saveApplication(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $application = new Application();
        $application->setUser($this->getUser())->getId();


        $form = $this->createForm(ApplicationType::class, $application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($application);
            $entityManager->flush();

            $this->addFlash('success','Your application was created successfully!');

        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/{id}", name="job_show", methods={"GET"})
     */
    public function show(Job $job): Response
    {
        $applications= $this->getDoctrine()
            ->getRepository(Application::class)
            ->findBy(['job'=>$job->getId()]);

        $application = new Application();

        $form = $this->createForm(ApplicationType::class, $application);

        return $this->render('job/show.html.twig', [
            'job' => $job,
            'applications' => $applications,
            'form' => $form->createView(),
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
