<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Entity\Usuario;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;

class UserController extends AbstractController
{


    /* Todo es nuevo, revisar: */



    /* Aqui creamos una funcion para CONSULTAR los usuarios existentes en mi bbdd, un metodo get en esta url http://localhost/symfony2/public/index.php/api/usuario */

    /**
     * @Route("/api/users", name="users", methods={"GET"})
     */
    public function users(Request $request, UserRepository $userRepository): Response
    {

        $users = $userRepository->findAll();
        $response = [];
        foreach ($users as $user) {
            $response[] = [
                'id' => $user->getId(),
                'email' => $user->getEmail()
            ];
        }

        return new JsonResponse([
            'users' => $response
        ]);
    }



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
