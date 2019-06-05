<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ServiceRepository;
use App\Repository\DetailServiceRepository;
use PHPStan\Symfony\Service;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(ServiceRepository $service)
    {
        $services = $service->findAll();

        return $this->render('accueil/index.html.twig', [
            'services' => $services,
        ]);
    }


    /**
     * @Route("/accueil/{id}", name="accueil_service")
     */
    public function detail(DetailServiceRepository $detail_service, Service $service)
    {
        $detail_service = $detail_service->findBy(['service' => $service->getId()]);

        return $this->render('services/details.html.twig', [
            'controller_name' => 'ServicesController',
            'details' => $detail_service,
            'service' => $service
        ]);
    }
}
