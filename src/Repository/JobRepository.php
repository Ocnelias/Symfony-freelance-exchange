<?php


namespace App\Repository;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Entity\Job;

class JobRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Job::class);
    }

    public function findAll()
    {
        return $this->createQueryBuilder('i')
            ->orderBy('i.id', 'DESC')
            ->setMaxResults(100)
            ->getQuery()
            ->execute()
            ;
    }

    public function findByTitle($q)
    {
        return $this->createQueryBuilder('i')
            ->where('i.title LIKE :val')
            ->setParameter('val', '%'.$q.'%')
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->execute()
            ;

     /*   return $this->createQueryBuilder('i')
            ->orderBy('i.id', 'DESC')
            ->setMaxResults(100)
            ->getQuery()
            ->execute()
            ;*/





    }

    /**
     * @return Job[]
     */
    public function findAllGreaterThanPrice($price): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Product p
            WHERE p.price > :price
            ORDER BY p.price ASC'
        )->setParameter('price', $price);

        // returns an array of Product objects
        return $query->getResult();
    }

}