<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\Category;
use App\Form\JobType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * @Route("/category")
 */
class CategoryController extends AbstractController
{

    /**
     * @Route("/get_subcategories", name="get_subcategories", methods={"GET"})
     *
     * Returns a JSON string with the subcategories with the providen id of main category.
     *
     * @param Request $request
     * @return JsonResponse| RedirectResponse
     */
    public function getSubcategories(Request $request)
    {
        if($request->isXmlHttpRequest()) {

            // Get Entity manager and repository
            $em = $this->getDoctrine()->getManager();
            $catsRepository = $em->getRepository(Category::class);

            $cats = $catsRepository->createQueryBuilder("q")
                ->where("q.parentId = :parentId")
                ->setParameter("parentId", $request->query->get("id"))
                ->getQuery()
                ->getResult();

            $responseArray = array();
            foreach ($cats as $cat) {
                $langTitle = 'getTitle' . $GLOBALS['request']->getLocale();
                $responseArray[] = array(
                    "id" => $cat->getId(),
                    "name" => $cat->{$langTitle}()
                );
            }

            // Return array with structure of the cats of the providen cat id
            return new JsonResponse($responseArray);
        } else {
            return $this->redirect('/');
        }

    }
}
