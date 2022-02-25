<?php

namespace App\Repository;

use App\Entity\Ride;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Throwable;

/**
 * @method Ride|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ride|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ride[]    findAll()
 * @method Ride[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RideRepository extends ServiceEntityRepository
{
    private $em;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        parent::__construct($registry, Ride::class);
    }


    public function createRide($data, User $user)
    {
        try {
            $ride = new Ride();

            $ride->setActive($data['active']);
            $ride->setCcaa($data['ccaa']);
            $ride->setName($data['name']);
            $ride->setLocation($data['location']);
            $ride->setAddress($data['address']);
            $ride->setTelephone($data['telephone']);
            $ride->setEmail($data['email']);
            $ride->setDuration($data['duration']);
            $ride->setDescription($data['description']);
            $ride->setLevel($data['level']);
            $ride->setUser($user);

            $this->getEntityManager()->persist($ride);
            $this->getEntityManager()->flush();
            return true;
        } catch (Throwable $exception) {
            return false;
        }
    }
    /* try catch si se produce una excepción en el bloque del try, entraría dentro del catch si se especifica la excepción (en este caso, si la consulta
    falla porque recibe un tipo de datos que no corresponde para ese campo)  */


    //ésta sería la opción para devolver todas las rutas que pertenezcan a un usuario mostrando solo las que le pertenecen a ese usuario:
    public function getRidesWithSelectByUser(array $select, User $user)
    {

        //ésto de abajo sería como hacer ésta consulta en phpmyadmin:  select {selectParam} from ride r where r.user_id = {userid}
        return $this->createQueryBuilder('r')
            ->select($select)
            ->andWhere('r.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

    //ésta función sería para devolver todas las rutas pero filtradas por lo que le indique en el select, por ejemplo getRides(['r.name'])(ver ApiController el endpoint read/select por ejemplo que ahí lo uso):
    public function getRides(array $select)
    {
        //ésto de abajo sería como hacer ésta consulta en phpmyadmin:  select {selectParam} from ride r

        return $this->createQueryBuilder('r')
            ->select($select)
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
