<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\DetailService;
use App\Repository\DetailServiceRepository;
use App\Repository\ServiceRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ServicesController extends AbstractController
{
    /**
     * @Route("/services", name="services")
     */
    public function index(ServiceRepository $service)
    {
        $services = $service->findBy(['visible'=>1]);

        return $this->render('services/index.html.twig', [
            'services' => $services
        ]);
    }



    /**
     * @Route("/services/{id}", name="service_detail")
     */
    public function details(Service $service, DetailServiceRepository $detail_service)
    {

        $detail_service = $detail_service ->findBy(['service'=>$service->getId()]);

        return $this->render('services/details.html.twig', [
            'details' => $detail_service,
            'service' => $service
        ]);
    }
}
