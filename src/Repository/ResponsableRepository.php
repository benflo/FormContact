<?php

namespace App\Repository;

use App\Entity\Responsable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ResponsableRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Responsable::class);
    }

    /**
     * @param int $departmentId
     *
     * @return array|null
     */
    public function findByDepartmentId(int $departmentId)
    {
        return $this->createQueryBuilder('r')
            ->select('r.email')
            ->where('r.departement = :departmentId')
            ->setParameter(':departmentId', $departmentId)
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
