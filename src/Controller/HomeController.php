<?php

namespace App\Controller;

use App\Entity\Restaurant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\RestaurantRepository;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]




    public function index(RestaurantRepository $restaurantRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'restaurants' => $restaurantRepository->findLastTenElements(),
        ]);
    }
}
