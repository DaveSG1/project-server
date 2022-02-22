<?php

namespace App\Controller;

use App\Entity\Ride;
use App\Repository\RideRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/rides", name="rides", methods={"GET"})
     */
    public function rides(RideRepository $rideRepository): Response
    {
        $rides = $rideRepository->findAll();
        $response = [];
        foreach ($rides as $ride) {
            $response[] = [
                'id' => $ride->getId(),
                'name' => $ride->getName(),
                'ccaa' => $ride->getCcaa(),
                'location' => $ride->getLocation()
            ];
        }

        return new JsonResponse(
            $response
        );
    }

    /* Éste endpoint es para que me devuelva la ruta que le pasemos por parámetros (al hacer click en la ruta 
    que queramos le paso el id por parametros para que me devuelva la información de dicha ruta en concreto 
    en la FichaPage): */

    /**
     * @Route("/api/ride/{id}", name="ride", methods={"GET"}, requirements={"id": "\d+"} )
     */
    public function ride(int $id, RideRepository $rideRepository): Response
    {
        $ride = $rideRepository->find($id);
        $response = [
            'id' => $ride->getId(),
            'name' => $ride->getName(),
            'ccaa' => $ride->getCcaa(),
            'address' => $ride->getAddress(),
            'telephone' => $ride->getTelephone(),
            'email' => $ride->getEmail(),
            'duration' => $ride->getDuration(),
            'description' => $ride->getDescription(),
            'level' => $ride->getLevel()
        ];


        return new JsonResponse(
            $response
        );
    }

    /* Éste endpoint es para el formulario de reserva, para que devuelva el nombre de cada ruta para poderlo 
    seleccionar en el desplegable: */

    /**
     * @Route("/api/rides/select", name="select", methods={"GET"})
     */
    public function select(RideRepository $rideRepository): Response
    {
        $rides = $rideRepository->findAll();
        $select = [];
        foreach ($rides as $ride) {
            $select[] = $ride->getName();
        }

        return new JsonResponse(
            $select
        );
    }


    /* A partir de aquí es nuevo, revisar: */

    /* Para añadir una entrada a la tabla Ride: */

    /**
     * @Route("/api/ride", name="ride", methods={"POST"})
     */
    public function add(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        $data = json_decode($request->getContent(), true);       /* con true para que devuelva un array */

        /* if($this->getUser()->getRide()){
            return $this->json([
                'message' => "Ride exists"
            ],
                Response::HTTP_FORBIDDEN
            );
        } */

        $ride = new Ride();

        $ride->setCcaa($data['ccaa']);
        $ride->setName($data['name']);
        $ride->setLocation($data['location']);
        $ride->setAddress($data['address']);
        $ride->setTelephone($data['telephone']);
        $ride->setEmail($data['email']);
        $ride->setDuration($data['duration']);
        $ride->setDescription($data['description']);
        $ride->setLevel($data['level']);
        $ride->setActive(true);
        /* insertar la imagen aqui como otro elemento o fuera? */

        /* $userId = $this->getUser()->getId();
        $ride->setUser($userRepository->find($userId)); */


        $this->em->persist($ride);
        $this->em->flush();

        return $this->json($ride, Response::HTTP_CREATED);
    }
}
