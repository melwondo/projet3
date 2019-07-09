<?php

namespace App\Controller;

use App\Repository\GestionPageRepository as Page;
use App\Repository\PartenaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PartenairesController extends AbstractController
{
    /**
     * @Route("/partenaires", name="partenaires")
     */
    public function index(PartenaireRepository $partenaires, Page $pageRepository)
    {
        $blocsPage = $pageRepository->findBy(['PageAssociee'=>'Partenaires', 'Visible'=>1]);
        $partenaires = $partenaires->findAllOrderByAlpha();
        return $this->render('partenaires/index.html.twig', [
            'partenaires' => $partenaires,
            'blocs' => $blocsPage,
        ]);
    }
}
