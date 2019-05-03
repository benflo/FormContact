<?php

namespace App\Repository;

use App\Entity\Responsables;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Responsables|null find($id, $lockMode = null, $lockVersion = null)
 * @method Responsables|null findOneBy(array $criteria, array $orderBy = null)
 * @method Responsables[]    findAll()
 * @method Responsables[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResponsablesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Responsables::class);
    }

    // /**
    //  * @return Responsables[] Returns an array of Responsables objects
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
    public function findOneBySomeField($value): ?Responsables
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
