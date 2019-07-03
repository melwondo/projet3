<?php

namespace App\Controller;

use App\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    /**
     * @Route("/menu", name="menu")
     */
    public function index($route = "")
    {
        $services = $this->getDoctrine()
            ->getRepository(Service::class)
            ->findBy(['visible'=>1]);


        return $this->render('navbar.html.twig', [
            'services' => $services,
            'route'=> $route
        ]);
    }
}
