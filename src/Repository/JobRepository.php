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

    public function findBySearchParams($search_data=null, $search_cats=null)
    {

        $query=$this->createQueryBuilder('i')
            ->orderBy('i.id', 'DESC');

        $search_data['isPermanent'] ? $query->where('i.isPermanent = :isPermanentVal')->setParameter('isPermanentVal', $search_data['isPermanent']) : '';
        $search_data['salary_from'] ? $query->andWhere('i.salary > :salaryFromVal')->setParameter('salaryFromVal', $search_data['salary_from']) : '';
        $search_data['salary_to'] ? $query->andWhere('i.salary < :salaryToVal')->setParameter('salaryToVal', $search_data['salary_to']) : '';
        $search_cats ? $query->andWhere("i.category IN (:search_cats) ")->setParameter('search_cats', $search_cats): '';
        $query->getQuery()->execute();

        return $query;
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

    }


}