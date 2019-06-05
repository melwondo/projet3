<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ServiceRepository;
use App\Entity\DetailService;
use App\Repository\DetailServiceRepository;

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
    public function detail(DetailService $service)
    {
        $detail_service = $service->findBy(['id' => $service->getId()]);

        return $this->render('services/details.html.twig', [
            'controller_name' => 'ServicesController',
            'details' => $detail_service,
            'service' => $service
        ]);
    }
}
