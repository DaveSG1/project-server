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
    private $rideRepository;

    public function __construct(RideRepository $rideRepository)
    {
        $this->rideRepository = $rideRepository;
    }

    /* Éste endpoint es el que uso en RutasPage y me devuelve la info escueta de cada ruta (en la linea 36 digo q datos quiero traerme de la bbdd y en Ruta cual de esos datos quiero pintar)
    cargará en la url "http://localhost:8000/api/rides/read": */

    /**
     * @Route("/read", name="read_rides", methods={"GET"})
     */
    public function allRidesAction(): Response
    {
        return new JsonResponse(
            [
                'data' => $this->rideRepository->getRides(['r.id, r.name ,r.ccaa', 'r.location', 'r.image']),   /* y aqui los campos que quiero del $select ésto es lo realmente importante, lo que uso */
            ]
        );
    }


    /* Éste endpoint lo usaré en el crud y me devuelve todas las rutas que gestione un determinado usuario (el que esté conectado) (en la linea 53 digo q datos quiero traerme de la bbdd y en el front diré cual de esos datos quiero pintar)
    cargará en la url "http://localhost:8000/api/rides/read/user/{user}": */

    /**
     * @Route("/read/user/{user}", name="rides_shown_by_user", methods={"GET"})
     */
    public function ridesByUserAction(User $user): Response
    {
        return new JsonResponse(
            [
                'data' => $this->rideRepository->getRidesWithSelectByUser(['r.id, r.name ,r.ccaa', 'r.location', 'r.level'], $user),
            ]
        );
    }


    /* Éste endpoint lo uso en FichaPage y me devuelve toda la info ampliada de una ruta en particular (en la linea 69 enlaza con la función toArray que he creado yo en la entidad Ride y allí digo q datos quiero traerme de la bbdd y en el front diré cual de esos datos quiero pintar)
    cargará en la url `http://localhost:8000/api/rides/read/route/${id}` donde ${id} será el id de la ruta particular a consultar: */

    /**
     * @Route("/read/route/{ride}", name="show_detailed_ride", methods={"GET"})
     */
    public function getRouteAction(Ride $ride): Response
    {
        return new JsonResponse(
            ['data' => $this->rideRepository->getRideWithUser($ride)]
        );
    }


    /* Éste endpoint lo uso en Reservas en el front y es para el formulario de reserva, para que devuelva las fechas disponibles para una ruta
    Lo cargará en la url "http://localhost:8000/api/rides/read/booking/see/{ride}": */

    /**
     * @Route("/read/booking/see/{ride}", name="read-booking", methods={"GET"})
     */
    public function seeBookingAvailabilityAction(Ride $ride): Response
    {
        return new JsonResponse(
            ['data' => $this->rideRepository->getRideWithAvailability($ride)]
        );
    }


    /* Éste endpoint lo usaré en el crud y es para añadir una nueva ruta a la bbdd por el usuario activo 
    cargará en la url `http://localhost:8000/api/rides/create/${id}` donde ${id} será el id del usuario activo: */

    /**
     * @Route("/create/{user}", name="create-ride", methods={"POST"})
     */
    public function createAction(Request $request, User $user): Response
    {
        $data = json_decode($request->getContent(), true);
        $status = $this->rideRepository->createRide($data, $user);   /* sera true o false según recibe del Riderepository (si se crea o no la entrada) */

        return new JsonResponse([
            'status' => $status,
            'message' => $status ? "Todo ha ido ok" : "Has metido datos que no corresponden"    /* Ésto es lo que envía al front como respuesta. Si los datos introducidos has sido correctos devolvera Todo ha ido ok, si no, dira Has metido datos que no corresponden */
        ]);
    }


    /* Éste endpoint es para editar una entrada en concreto de la tabla Ride. 
    Lo cargará en la url `http://localhost:8000/api/rides/edit/${ride}` donde ${ride} será el id de la ruta que queramos modificar: */

    /**
     * @Route("/edit/{ride}", name="edit-ride", methods={"PUT"})
     */
    // public function editAction(Ride $ride, Request $request): Response
    // {
    //     $data = json_decode($request->getContent(), true);
    //     $this->rideRepository->editRide($data, $ride);

    //     return new JsonResponse(['status' => true]);
    // }



    /* Éste endpoint es para eliminar una entrada en concreto de la tabla Ride. 
    Lo cargará en la url `http://localhost:8000/api/rides/delete/${ride}` donde ${ride} será el id de la ruta que queramos eliminar: */

    /**
     * @Route("/delete/{ride}", name="delete-ride", methods={"DELETE"})
     */
    // public function deleteAction(Ride $ride): Response
    // {
    //     return new JsonResponse(
    //         ['status' => $this->rideRepository->deleteRide($ride)]
    //     );
    // }
}
