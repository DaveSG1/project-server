<?php

namespace App\Controller;

use App\Entity\Ride;
use App\Entity\User;
use App\Repository\RideRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/rides")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/read", name="read_rides", methods={"GET"})
     */
    public function allRidesAction(RideRepository $rideRepository): Response
    {
        return new JsonResponse(
            [
                /*  'status' => true,
                'message' => 'TODO OK',                            ésto es la respuesta genérica, en mi caso no le estoy dando uso 
                'timestamp' => (new DateTime())->format('y-m-d'), */

                'data' => $rideRepository->getRides(['r.id, r.name ,r.ccaa', 'r.location']),   /* y aqui los campos que quiero del $select ésto es lo realmente importante, lo que uso */
            ]
        );
    }


    /**
     * @Route("/read/user/{user}", name="rides_shown_by_user", methods={"GET"})
     */
    public function ridesByUserAction(RideRepository $rideRepository, User $user): Response
    {
        return new JsonResponse(
            [
                'data' => $rideRepository->getRidesWithSelectByUser(['r.id, r.name ,r.ccaa', 'r.location', 'r.level'], $user),
            ]
        );
    }

    /**
     * @Route("/read/route/{ride}", name="show_detailed_ride", methods={"GET"})
     */
    public function getRouteAction(Ride $ride): Response
    {
        return new JsonResponse(
            [
                'data' => $ride->toArray(),         /* aqui llamo a la funcion toArrray que he creado yo en el modelo (entidad) Ride */
            ]
        );
    }
    /**
     * @Route("/create/{user}", name="create-ride", methods={"POST"})
     */
    public function createAction(Request $request, RideRepository $rideRepository, User $user)
    {
        $data = json_decode($request->getContent(), true);
        $status = $rideRepository->createRide($data, $user);   /* sera true o false según recibe del Riderepository (si se crea o no la entrada) */

        return new JsonResponse([
            'status' => $status,
            'message' => $status ? "Todo ha ido ok" : "Has metido datos que no corresponden"    /* Ésto es lo que envía al front como respuesta. Si los datos introducidos has sido correctos devolvera Todo ha ido ok, si no, dira Has metido datos que no corresponden */
        ]);
    }

    /* Éste endpoint es para el formulario de reserva, para que devuelva el nombre de cada ruta para poderlo 
    seleccionar en el desplegable: */

    /**
     * @Route("/read/select", name="select", methods={"GET"})
     */
    public function select(RideRepository $rideRepository): Response
    {
        return new JsonResponse(
            ['data' => $rideRepository->getRides(['r.name', 'r.id'])]
        );
    }
}
