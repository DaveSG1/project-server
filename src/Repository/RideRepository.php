<?php

namespace App\Repository;

use App\Entity\Ride;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ride|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ride|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ride[]    findAll()
 * @method Ride[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RideRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ride::class);
    }

    //ésta sería la opción para devolver todas las rutas que pertenezcan a un usuario mostrando l
    public function getRidesWithSelectByUser(array $select, User $user)
    {

        //select {selectParam} from ride r where r.user_id = {userid}
        return $this->createQueryBuilder('r')
            ->select($select)
            ->andWhere('r.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }
    public function getRidesWithSelect($select)
    {
        //select {selectParam} from ride r

        return $this->createQueryBuilder('r')
            ->select($select)
            ->getQuery()
            ->getResult();
    }

    public function getRides()
    {
        return $this->createQueryBuilder('r')
            ->select(['r.id, r.name ,r.ccaa', 'r.location', 'r.level'])
            ->getQuery()
            ->getResult();
    }
    /**            
 
     */

    // /**
    //  * @return Ride[] Returns an array of Ride objects
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
    public function findOneBySomeField($value): ?Ride
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
