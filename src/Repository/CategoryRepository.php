<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IsSystem|null find($id, $lockMode = null, $lockVersion = null)
 * @method IsSystem|null findOneBy(array $criteria, array $orderBy = null)
 * @method IsSystem[]    findAll()
 * @method IsSystem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @return Category[]
     */
    public function findMainCategories()
    {
        return $this->createQueryBuilder('i')
        ->andWhere('i.parentId = :val')
        ->setParameter('val', 0)
        ->orderBy('i.id', 'ASC')
        ->setMaxResults(100)
        ->getQuery()
        ->execute()
            ;
    }

    /**
     * @return Category[]
     */
    public function getCategoryList()
    {
        $list=[];

        foreach ($this->findMainCategories() as $mainCategory) {
            $list[$mainCategory->getId()][$mainCategory->getId()] = $mainCategory->getLocalizedTitle();
        }

        foreach ($list as $key=>$cat){
            $subcats= $this->createQueryBuilder('s')
                ->andWhere('s.parentId = :val')
                ->setParameter('val', $key)
                ->orderBy('s.id', 'ASC')
                ->setMaxResults(100)
                ->getQuery()
                ->execute()
            ;

            foreach ($subcats as $subcat){
                $list[$key][$subcat->getId()] = $subcat->getLocalizedTitle();
            }
        }

        return $list ;
    }


}
