<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ServiceRepository;
use App\Repository\DetailServiceRepository;
use PHPStan\Symfony\Service;
use App\Repository\PartenaireRepository;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(ServiceRepository $service, PartenaireRepository $partenaire)
    {
        $services = $service->findAll();
        $partenaires = $partenaire->findAll();


        return $this->render('accueil/index.html.twig', [
            'services' => $services,
            'partenaires' => $partenaires,
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
