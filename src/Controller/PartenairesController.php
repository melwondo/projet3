<?php

namespace App\Controller;

use App\Repository\PartenaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PartenairesController extends AbstractController
{
    /**
     * @Route("/partenaires", name="partenaires")
     */
    public function index(PartenaireRepository $partenaires)
    {
        $partenaires = $partenaires->findAll();
        return $this->render('partenaires/index.html.twig', [
            'partenaires' => $partenaires,
        ]);
    }
}
