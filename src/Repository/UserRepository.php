<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Throwable;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    /* Ésta función sería para devolver todos los usario pero filtradas por lo que le indique en el select en cada caso en la UserController, 
    por ejemplo si en la UserController, pongo en getUsers(['u.email']) me traeré de la bbdd sólo los emails de los usuarios (ver UserController el endpoint   por ejemplo que ahí lo uso): */
    public function getUsers(array $select)
    {
        //ésto de abajo sería como hacer ésta consulta en phpmyadmin:  select {selectParam} from user u

        return $this->createQueryBuilder('u')
            ->select($select)
            ->getQuery()
            ->getResult();
    }


    /* Ésta función es para añadir un usuario nuevo: */

    public function createUser($data)
    {
        try {
            $user = new User();

            $user->setEmail($data['email']);
            $user->setActive($data['active']);
            $user->setRoles($data['roles']);
            $user->setPassword($data['password']);

            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush();
            return true;
        } catch (Throwable $exception) {
            return false;
        }
    }
    /* try catch sirve para que, si se produce una excepción en el bloque del try, entraría dentro del catch donde se especifica la excepción (en este caso, si la consulta
    falla porque recibe un tipo de datos que no corresponde para ese campo, la función createUser devolverá un false, si los datos introducidos son correctos, devolvera un true)  */


    /* CONSULTA NUEVA CREADA, A REVISAR: */


    /* Ésta función (consulta) es para que me devuelva un usuario (con su email y password): */

    public function findByEmailAndPass($email, $password): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.email = :email')
            ->setParameter('email', $email)
            ->andWhere('u.password = :password')
            ->setParameter('password', $password)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
