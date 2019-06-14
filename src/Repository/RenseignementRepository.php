<?php

namespace App\Repository;

use App\Entity\Renseignement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Renseignement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Renseignement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Renseignement[]    findAll()
 * @method Renseignement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RenseignementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Renseignement::class);
    }

    // /**
    //  * @return Renseignement[] Returns an array of Renseignement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Renseignement
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
