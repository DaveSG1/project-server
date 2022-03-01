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


class TestController extends AbstractController
{
    /*
    private $apiController;
    private $rideRepository;

    public function __construct(ApiController $apiController, RideRepository $rideRepository)
    {
        $this->apiController = $apiController;
        $this->rideRepository = $rideRepository;
    }

    public function deleteAllRides()
    {
        foreach ($this->rideRepository->findAll() as $ride) {
            $this->apiController->delete($ride);
        }
        $this->apiController->sayHello();
    }
     */
}
