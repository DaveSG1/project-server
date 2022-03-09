<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/api/users")
 */

class UserController extends AbstractController
{


    /* Todo es nuevo, revisar: */



    /* Aqui creamos una funcion para CONSULTAR los usuarios existentes en mi bbdd, un metodo get en esta url "http://localhost:8000/api/users/read" */



    /* Éste endpoint me devuelve todos los usuarios de la bbdd 
    cargará en la url "http://localhost:8000/api/users/read": */

    /**
     * @Route("/read", name="read_users", methods={"GET"})
     */
    public function allUsersAction(UserRepository $userRepository): Response
    {
        return new JsonResponse(
            [
                /*  'status' => true,
                'message' => 'TODO OK',                            ésto es la respuesta genérica, en mi caso no le estoy dando uso 
                'timestamp' => (new DateTime())->format('y-m-d'), */

                'data' => $userRepository->getUsers(['u.id, u.email, u.active, u.roles ,u.password']),   /* y aqui los campos que quiero del $select ésto es lo realmente importante, lo que uso */
            ]
        );
    }


    /* Éste endpoint es para añadir un usuario nuevo a la bbdd, y lo usaré en el formulario de registro de nuevo usuario. 
    Cargará en la url "http://localhost:8000/api/users/create" : */

    /**
     * @Route("/create", name="create-user", methods={"POST"})
     */
    public function createUserAction(Request $request, UserRepository $userRepository)
    {
        $data = json_decode($request->getContent(), true);
        $status = $userRepository->createRide($data);   /* sera true o false según recibe del Riderepository (si se crea o no la entrada) */

        return new JsonResponse([
            'status' => $status,
            'message' => $status ? "Todo ha ido ok" : "Has metido datos que no corresponden"    /* Ésto es lo que envía al front como respuesta. Si los datos introducidos has sido correctos devolvera Todo ha ido ok, si no, dira Has metido datos que no corresponden */
        ]);
        //hola mundo desde un comitt antiguo escrito pòr miguel!
    }






    /* ÉSTOS DE ABAJO SON LOS ENDPOINTS ANTIGUOS (NO LOS ESTOY USANDO AHORA) QUE ME CREE SIGUIENDO EL EJEMPLO DEL EJERCICIO REALIZADO EN CLASE DE JOSE: */


    /* Aqui creamos una funcion para AÑADIR usuarios nuevos a mi bbdd, un metodo post en esta url http://localhost/symfony2/public/index.php/api/usuario */

    /**
     * @Route("/api/user", methods={"POST"})
     */
    public function add(Request $request, EntityManagerInterface $em)
    {
        $content = json_decode($request->getContent(), true);

        $user = new User();
        $user->setEmail($content['email']);
        $user->setRoles($content['roles']);   /* ej en el json: {"roles": ["ROLE_ADMIN"]} ó {"roles": ["ROLE_USER"]} ó {"roles": ["ROLE_USER, ROLE_ADMIN"]} */
        $user->setPassword($content['password']);

        $em->persist($user);
        $em->flush();

        return new JsonResponse([
            'result' => 'ok',
            'content' => $content
        ]);
    }



    /* Aqui creamos una funcion para EDITAR un usuario ya existente en mi bbdd (le paso el id del usuario por parametros en la ruta y los recibe como parametros en la funcion), un metodo put en esta url http://localhost/symfony2/public/index.php/api/usuario */

    /**
     * @Route("/api/user/{id}", methods={"PUT"})
     */
    public function modificar($id, UserRepository $userRepository, Request $request, EntityManagerInterface $em)
    {
        $content = json_decode($request->getContent(), true);  /* para que me devuelva los datos de la bbdd (en json) en un array */

        $user = $userRepository->find($id);            /* con esto buscara en mi usuarioRepository que tengo toda la tabla de usuarios, aquel con la id que coincida con la q le hemos metido por parametros y lo guardara en la variable $usuario */


        if (isset($content['email'])) {                         /* con estas expresiones le digo que si tiene datos en ese campo y recibe nuevos datos, los sobreescriba, si no recibe nada, que respete el contenido actual para ese campo  */
            $user->setEmail($content['email']);
        }

        if (isset($content['roles'])) {                         /* con estas expresiones le digo que si tiene datos en ese campo y recibe nuevos datos, los sobreescriba, si no recibe nada, que respete el contenido actual para ese campo  */
            $user->setEmail($content['roles']);
        }

        if (isset($content['password'])) {                         /* con estas expresiones le digo que si tiene datos en ese campo y recibe nuevos datos, los sobreescriba, si no recibe nada, que respete el contenido actual para ese campo  */
            $user->setEmail($content['password']);
        }


        $em->flush();

        return new JsonResponse([
            'result' => 'ok'
        ]);
    }


    /* Aqui creamos una funcion para BORRAR un usuario ya existente en mi bbdd (le paso el id del usuario por parametros en la ruta y los recibe como parametros en la funcion), un metodo put en esta url http://localhost/symfony2/public/index.php/api/usuario */

    /**
     * @Route("/api/user/{id}", methods={"DELETE"})
     */
    public function borrar($id, UserRepository $userRepository, EntityManagerInterface $em)
    {
        $user = $userRepository->find($id);
        $em->remove($user);

        $em->flush();

        return new JsonResponse([
            'result' => 'ok'
        ]);
    }
}
