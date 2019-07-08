<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MentionsLegalesController extends AbstractController
{
    /**
     * @Route("/mentions/legales", name="mentions_legales")
     */
    public function index()
    {
        return $this->render('mentions_legales/index.html.twig', [
            'controller_name' => 'MentionsLegalesController',
        ]);
    }
}
