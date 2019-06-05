<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ServiceRepository;

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
}
