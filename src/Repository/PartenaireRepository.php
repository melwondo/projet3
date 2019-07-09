<?php

namespace App\Repository;

use App\Entity\Partenaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Partenaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partenaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partenaire[]    findAll()
 * @method Partenaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartenaireRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Partenaire::class);
    }

    /**
     * @return Partenaire[] Returns an array of Partenaire objects
     */

    public function findAllOrderByAlpha()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.visible = 1')
            ->orderBy('p.OrdreAffichage', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Partenaire
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
