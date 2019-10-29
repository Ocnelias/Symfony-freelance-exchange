<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\Category;
use App\Form\JobType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @return JsonResponse
     */
    public function getSubcategories(Request $request)
    {
        // Get Entity manager and repository
        $em = $this->getDoctrine()->getManager();
        $catsRepository = $em->getRepository(Category::class);

        // Search the cats that belongs to the city with the given id as GET parameter "cityid"
        $cats = $catsRepository->createQueryBuilder("q")
            ->where("q.parentId = :parentId")
            ->setParameter("parentId", $request->query->get("id"))
            ->getQuery()
            ->getResult();

        $responseArray = array();
        foreach($cats as $cat){
            $langTitle='getTitle' . $GLOBALS['request']->getLocale();
            $responseArray[] = array(
                "id" => $cat->getId(),
                "name" => $cat->{$langTitle}()
            );
        }

        // Return array with structure of the cats of the providen city id
        return new JsonResponse($responseArray);

    }
}
