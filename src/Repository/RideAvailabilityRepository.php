<?php

namespace App\Repository;

use App\Entity\RideAvailability;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RideAvailability|null find($id, $lockMode = null, $lockVersion = null)
 * @method RideAvailability|null findOneBy(array $criteria, array $orderBy = null)
 * @method RideAvailability[]    findAll()
 * @method RideAvailability[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RideAvailabilityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RideAvailability::class);
    }

    // /**
    //  * @return RideAvailability[] Returns an array of RideAvailability objects
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
    public function findOneBySomeField($value): ?RideAvailability
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
