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


    /* Ésta función sería para devolver todas las rutas pero filtradas por lo que le indique en el select en cada caso en la ApiController, 
    por ejemplo si en la ApiController, pongo en getRides(['r.name']) me traeré de la bbdd sólo los nombres de las rutas (ver ApiController el endpoint read/select por ejemplo que ahí lo uso): */

    public function getRides(array $select)
    {
        //ésto de abajo sería como hacer ésta consulta en phpmyadmin:  select {selectParam} from ride r

        return $this->createQueryBuilder('r')->where('r.active = 1')
            ->select($select)
            ->getQuery()
            ->getResult();
    }


    /* Ésta función sería para devolver todas las rutas pero añadiendo la disponibilidad de fecha y hora de cada una de esas rutas: */

    public function getRideWithAvailability(Ride $ride)
    {
        $query = $this->createQueryBuilder('r')
            ->select(["r", "a"])
            ->andWhere('r.id = :id')
            ->setParameter('id', $ride->getId())
            ->leftJoin("r.rideAvailabilities", "a", "a.ride_id = r.id")
            ->getQuery()
            ->getArrayResult();

        foreach ($query as &$ride) {
            foreach ($ride['rideAvailabilities'] as &$rideAvailabilities) {
                $date = $rideAvailabilities["date"];
                $date_formatted = $date->format('d-m-Y');

                $time = $rideAvailabilities["time"];
                $time_formatted = $time->format('H:i');

                $date_time = $date_formatted . " " . $time_formatted;

                unset($rideAvailabilities["time"]);
                unset($rideAvailabilities["date"]);

                $rideAvailabilities["datetime"] = $date_time;
            }
        }

        return $query;
    }


    /* Ésta función sería para devolver sólo todas las rutas que pertenezcan a un usuario determinado. El select es para que en el ApiController pueda yo decirle qué datos quiero traerme
    de la bbdd, por ejemplo si en la ApiController, pongo en getRidesWithSelectByUser(['r.id, r.name ,r.ccaa', 'r.location', 'r.level'] me traeré de la bbdd sólo id, name, ccaa, location, level : */

    public function getRidesWithSelectByUser(array $select, User $user)
    {

        //ésto de abajo sería como hacer ésta consulta en phpmyadmin:  select {selectParam} from ride r where r.user_id = {userid}
        return $this->createQueryBuilder('r')->where('r.active = 1')
            ->select($select)
            ->andWhere('r.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }


    //Ésta función es para añadir una ruta nueva un determinado usuario (el que haya iniciado sesión):

    public function createRide(array $data, User $user)
    {
        try {
            $ride = new Ride();

            $ride->setActive($data['active']);
            $ride->setCcaa($data['ccaa']);
            $ride->setName($data['name']);
            $ride->setLocation($data['location']);
            $ride->setAddress($data['address']);
            $ride->setTelephone($data['telephone']);
            $ride->setDuration($data['duration']);
            $ride->setDescription($data['description']);
            $ride->setLevel($data['level']);
            $ride->setUser($user);

            $imagen = (isset($data['imagen'])) ? $data['imagen'] : 'https://images.ecestaticos.com/rZeqqdQkqrChHdT5Mw4NEfzBS-o=/0x0:2272x1514/1600x900/filters:fill(white):format(JPG)/f.elconfidencial.com/original/5f1/cfd/416/5f1cfd416b377fbc5a73a25e849db188.jpg';

            $ride->setImage($imagen);

            $this->getEntityManager()->persist($ride);
            $this->getEntityManager()->flush();
            return true;
        } catch (Throwable $exception) {
            return false;
        }
    }
    /* try catch sirve para que, si se produce una excepción en el bloque del try, entraría dentro del catch donde se especifica la excepción (en este caso, si la consulta
    falla porque recibe un tipo de datos que no corresponde para ese campo, la función createRide devolverá un false, si los datos introducidos son correctos, devolvera un true)  */




    /* Ésta función sería para editar una Ruta concreta: */

    public function editRide(array $data, Ride $ride, EntityManagerInterface $em): bool
    {
        try {

            if (!empty($data['ccaa'])) {
                $ride->setCcaa($data['ccaa']);
            }

            if (!empty($data['name'])) {
                $ride->setName($data['name']);
            }

            if (!empty($data['location'])) {
                $ride->setLocation($data['location']);
            }

            if (!empty($data['address'])) {
                $ride->setAddress($data['address']);
            }

            if (!empty($data['telephone'])) {
                $ride->setTelephone($data['telephone']);
            }

            if (!empty($data['duration'])) {
                $ride->setDuration($data['duration']);
            }

            if (!empty($data['description'])) {
                $ride->setDescription($data['description']);
            }

            if (!empty($data['level'])) {
                $ride->setLevel($data['level']);
            }

            $em->persist($ride);
            $em->flush();
            return true;
        } catch (Throwable $exception) {
            return false;
        }
    }


    /* Ésta función sería para eliminar una Ruta concreta: */

    public function deleteRide(int $id, RideRepository $rideRepository, EntityManagerInterface $em): bool
    {
        try {
            $ride = $rideRepository->find($id);
            $ride->setActive(false);             /* con ésta línea cambio la propiedad active a false (a 0 en lugar del 1 que tiene por defecto) y así hago un soft delete */
            $em->persist($ride);
            $em->flush();
            return true;
        } catch (Throwable $exception) {
            return false;
        }
    }

    /* Ésta función será para conectar ambas tablas para cargar el email de la tabla user en la tabla ride: */

    public function getRideWithUser(Ride $ride)
    {
        //ésto de abajo sería como hacer ésta consulta en phpmyadmin:  select * from ride r where r.id = (id de la ruta p.ej 2)
        return $this->createQueryBuilder('r')
            ->select(["r", "u"])
            ->andWhere('r.id = :id')
            ->join("r.user", "u", "u.id = r.user_id")
            ->setParameter('id', $ride->getId())
            ->getQuery()
            ->getArrayResult();
    }
}
