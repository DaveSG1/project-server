<?php

namespace App\Controller;

use App\Entity\Ride;
use App\Entity\User;
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

    /* Éste endpoint por ejemplo cargará en la pagina http://localhost:8000/api/rides */

    /* Éste endpoint es para que me devuelva todas las rutas: */

    /**
     * @Route("/api/rides/all", name="all-rides", methods={"GET"})
     */
    public function allRides(RideRepository $rideRepository): Response
    {
        return new JsonResponse(
            [
                'data' => $rideRepository->getRides()
            ]
        );
    }

    /* Éste endpoint NO SE PARA QUÉ ES, PREGUNTAR A MIGUEL: */

    /**
     * @Route("/api/rides", name="rides", methods={"GET"})
     */
    public function rides(RideRepository $rideRepository): Response
    {
        return new JsonResponse(
            [
                'data' => $rideRepository->getRidesWithSelect(['r.id, r.name ,r.ccaa', 'r.location', 'r.level']),
            ]
        );
    }

    /* Éste endpoint es para que me devuelva las rutas de un determinado usuario: */

    /**
     * @Route("/api/rides/{user}", name="rides-user", methods={"GET"})
     */
    public function ridesByUser(RideRepository $rideRepository, User $user): Response
    {
        return new JsonResponse(
            [
                'data' => $rideRepository->getRidesWithSelectByUser(['r.id, r.name ,r.ccaa', 'r.location', 'r.level'], $user),
            ]
        );
    }



    /* Éste endpoint es para que me devuelva la info extendida de ruta que le pasemos por parámetros 
    (al hacer click en la ruta que queramos le paso el id por parametros para que me devuelva la información 
    de dicha ruta en concreto en la FichaPage): */

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

        /* insertar la imagen aqui como otro elemento o fuera? */


        $this->em->persist($ride);
        $this->em->flush();

        return new JsonResponse(
            $ride
        );
    }


    /* Para editar una entrada en concreto de la tabla Ride: */

    /**
     * @Route("/api/ride/{id}", methods={"PUT"})
     */
    public function update(Request $request, $id, RideRepository $rideRepository): Response
    {
        $content = json_decode($request->getContent(), true);

        $ride = $this->rideRepository->find($id);

        if (isset($content['ccaa'])) {
            $ride->setTexto($content['ccaa']);
        }
        if (isset($content['name'])) {
            $ride->setTexto($content['name']);
        }
        if (isset($content['location'])) {
            $ride->setTexto($content['location']);
        }
        if (isset($content['address'])) {
            $ride->setTexto($content['address']);
        }
        if (isset($content['telephone'])) {
            $ride->setTexto($content['telephone']);
        }
        if (isset($content['email'])) {
            $ride->setTexto($content['email']);
        }
        if (isset($content['duration'])) {
            $ride->setTexto($content['duration']);
        }
        if (isset($content['description'])) {
            $ride->setTexto($content['description']);
        }
        if (isset($content['level'])) {
            $ride->setTexto($content['level']);
        }
        if (isset($content['ccaa'])) {
            $ride->setTexto($content['ccaa']);
        }

        /* insertar la imagen aqui como otro elemento o fuera? */


        $this->em->flush();

        return new JsonResponse(['respuesta' => 'ok']);
    }



    /* Para eliminar una entrada en concreto de la tabla Ride: */

    /**
     * @Route("/api/ride/{id}", methods={"DELETE"})
     */
    public function delete($id): Response
    {
        $ride = $this->rideRepository->find($id);
        $this->em->remove($ride);
        $this->em->flush();

        return new JsonResponse(['respuesta' => 'ok']);
    }
}
