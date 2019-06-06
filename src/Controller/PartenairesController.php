<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PartenairesController extends AbstractController
{
    /**
     * @Route("/partenaires", name="partenaires")
     */
    public function index()
    {
        return $this->render('partenaires/index.html.twig', [
            'controller_name' => 'PartenairesController',
        ]);
    }
}
