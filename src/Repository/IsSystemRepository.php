<?php

namespace App\Repository;

use App\Entity\IsSystem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IsSystem|null find($id, $lockMode = null, $lockVersion = null)
 * @method IsSystem|null findOneBy(array $criteria, array $orderBy = null)
 * @method IsSystem[]    findAll()
 * @method IsSystem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IsSystemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IsSystem::class);
    }

    // /**
    //  * @return IsSystem[] Returns an array of IsSystem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IsSystem
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
