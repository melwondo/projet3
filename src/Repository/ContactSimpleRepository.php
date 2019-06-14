<?php

namespace App\Repository;

use App\Entity\ContactSimple;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ContactSimple|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactSimple|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactSimple[]    findAll()
 * @method ContactSimple[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactSimpleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ContactSimple::class);
    }

    // /**
    //  * @return ContactSimple[] Returns an array of ContactSimple objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContactSimple
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
