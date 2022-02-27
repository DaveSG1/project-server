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
    /* Éste endpoint es el que uso en RutasPage y me devuelve la info escueta de cada ruta (en la linea 36 digo q datos quiero traerme de la bbdd y en Ruta cual de esos datos quiero pintar)
    cargará en la url "http://localhost:8000/api/rides/read": */

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


    /* Éste endpoint lo usaré en el crud y me devuelve todas las rutas que gestione un determinado usuario (el que esté conectado) (en la linea 53 digo q datos quiero traerme de la bbdd y en el front diré cual de esos datos quiero pintar)
    cargará en la url "http://localhost:8000/api/rides/read/user/{user}": */

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


    /* Éste endpoint lo uso en FichaPage y me devuelve toda la info ampliada de una ruta en particular (en la linea 69 enlaza con la función toArray que he creado yo en la entidad Ride y allí digo q datos quiero traerme de la bbdd y en el front diré cual de esos datos quiero pintar)
    cargará en la url `http://localhost:8000/api/rides/read/route/${id}` donde ${id} será el id de la ruta particular a consultar: */

    /**
     * @Route("/read/route/{ride}", name="show_detailed_ride", methods={"GET"})
     */
    public function getRouteAction(Ride $ride): Response
    {
        return new JsonResponse(
            [
                'data' => $ride->toArray(),         /* aqui llamo a la funcion toArray que he creado yo en el modelo (entidad) Ride que es la que devuelve todos los datos de cada ruta que contiene la bbdd */
            ]
        );
    }

    /* Éste endpoint lo usaré en el crud y es para añadir una nueva ruta a la bbdd por el usuario activo 
    cargará en la url `http://localhost:8000/api/rides/create/${id}` donde ${id} será el id del usuario activo: */

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

    /* Éste endpoint lo uso en Reservas en el front y es para el formulario de reserva, para que devuelva el nombre de cada ruta para poderlo seleccionar en el desplegable
    Lo cargará en la url "http://localhost:8000/api/rides/read/select": */

    /**
     * @Route("/read/select", name="select", methods={"GET"})
     */
    public function select(RideRepository $rideRepository): Response
    {
        return new JsonResponse(
            ['data' => $rideRepository->getRides(['r.name', 'r.id'])]
        );
    }


    /* HASTA AQUÍ ESTÁN TODOS LOS ENDPOINTS TESTADOS EN THUNDER Y FUNCIONAN */



    /* ENDPOINTS NUEVOS, A REVISAR, AL INTENTAR EJECUTARLOS EN THUNDER DAN ERROR 500 DE ALGO RELACIONADO CON YAML (NO HE PODIDO IDENTIFICAR EL ERROR): */

    /* Para editar una entrada en concreto de la tabla Ride. 
    Lo cargará en la url `http://localhost:8000/api/rides/edit/${id}` donde ${id} será el id de la ruta que queramos modificar: */

    /**
     * @Route("/edit/{id}", name='edit-ride', methods={"PUT"})
     */
    public function edit(Request $request, $id, RideRepository $rideRepository): Response
    {
        $content = json_decode($request->getContent(), true);

        $ride = $this->$rideRepository->find($id);

        if (isset($content['active'])) {
            $ride->setTexto($content['active']);
        }
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
        if (isset($content['description'])) {
            $ride->setTexto($content['description']);
        }
        if (isset($content['duration'])) {
            $ride->setTexto($content['duration']);
        }
        if (isset($content['level'])) {
            $ride->setTexto($content['level']);
        }

        /* insertar la imagen aqui como otro elemento o fuera? */


        $this->em->flush();

        return new JsonResponse(['respuesta' => 'ok']);
    }



    /* Para eliminar una entrada en concreto de la tabla Ride. 
    Lo cargará en la url `http://localhost:8000/api/rides/delete/${id}` donde ${id} será el id de la ruta que queramos eliminar: */

    /**
     * @Route("/delete/{id}", name='delete-ride', methods={"DELETE"})
     */
    public function delete($id): Response
    {
        $ride = $this->rideRepository->find($id);
        $this->em->remove($ride);
        $this->em->flush();

        return new JsonResponse(['respuesta' => 'ok']);
    }
}
