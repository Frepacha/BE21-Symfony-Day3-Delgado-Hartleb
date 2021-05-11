<?php

namespace App\Repository;

use App\Entity\Sportname;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sportname|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sportname|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sportname[]    findAll()
 * @method Sportname[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SportnameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sportname::class);
    }

    // /**
    //  * @return Sportname[] Returns an array of Sportname objects
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
    public function findOneBySomeField($value): ?Sportname
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
