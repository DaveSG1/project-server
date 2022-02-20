<?php

namespace App\Controller;

use App\Repository\RideRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
