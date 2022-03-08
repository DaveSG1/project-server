<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/auth")
 */
class AuthController extends AbstractController
{

    /* ENDPOINT NUEVO A REVISAR, ENLAZA CON USERREPOSITORY: */
    /* Para que devuelva el usuario (email y password y devuelva también el token)
    Lo cargará en la url `http://localhost:8000/auth/token` */

    /**
     * @Route("/token", name="get-token", methods={"POST"})
     */
    public function getTokenAction(Request $request): Response
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $user = $this->userRepository->findByEmailAndPass($email, $password);

        /* $user = $this->get('security.token_storage')->getToken()->getUser(); */
        $jwtManager = $this->get('lexik_jwt_authentication.jwt_manager');
        $token = $jwtManager->create($user);

        dump($token);
        die;

        return new JsonResponse(['respuesta' => $user, 'usuario' => $this->userRespository->getUser()]);
    }
}
