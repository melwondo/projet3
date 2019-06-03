<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\DetailService;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class ServicesController extends AbstractController
{
    /**
     * @Route("/services", name="services")
     */
    public function index()
    {
        $services = $this->getDoctrine()
            ->getRepository(Service::class)
            ->findBy(['visible'=>1]);

        return $this->render('services/index.html.twig', [
            'controller_name' => 'ServicesController',
            'services' => $services
        ]);
    }



    /**
     * @Route("/services/{id}", name="service_detail")
     */
    public function details(Service $service)
    {
        $detail_service = $this->getDoctrine()
            ->getRepository(DetailService::class)
            ->findBy(['service'=>$service->getId()]);

        return $this->render('services/details.html.twig', [
            'controller_name' => 'ServicesController',
            'details' => $detail_service,
            'service' => $service
        ]);
    }
}
