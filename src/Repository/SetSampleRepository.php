<?php

namespace App\Repository;

use App\Entity\SetSample;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SetSample|null find($id, $lockMode = null, $lockVersion = null)
 * @method SetSample|null findOneBy(array $criteria, array $orderBy = null)
 * @method SetSample[]    findAll()
 * @method SetSample[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SetSampleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SetSample::class);
    }

    // /**
    //  * @return SetSample[] Returns an array of SetSample objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SetSample
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
