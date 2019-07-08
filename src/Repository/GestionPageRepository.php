<?php

namespace App\Repository;

use App\Entity\GestionPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GestionPage|null find($id, $lockMode = null, $lockVersion = null)
 * @method GestionPage|null findOneBy(array $criteria, array $orderBy = null)
 * @method GestionPage[]    findAll()
 * @method GestionPage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GestionPageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GestionPage::class);
    }

    // /**
    //  * @return GestionPage[] Returns an array of GestionPage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GestionPage
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
