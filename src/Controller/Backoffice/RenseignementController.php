<?php

namespace App\Controller\Backoffice;

use App\Entity\Renseignement;
use App\Form\RenseignementType;
use App\Repository\RenseignementRepository;
use Nette\Utils\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/renseignement")
 */
class RenseignementController extends AbstractController
{
    /**
     * @Route("/", name="renseignement_index", methods={"GET"})
     */
    public function index(RenseignementRepository $renseignementRepository): Response
    {
        return $this->render('Backoffice/renseignement/index.html.twig', [
            'renseignements' => $renseignementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="renseignement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $renseignement = new Renseignement();
        $form = $this->createForm(RenseignementType::class, $renseignement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $renseignement->setDateMessage(new DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($renseignement);
            $entityManager->flush();

            return $this->redirectToRoute('renseignement_index');
        }

        return $this->render('Backoffice/renseignement/new.html.twig', [
            'renseignement' => $renseignement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="renseignement_show", methods={"GET"})
     */
    public function show(Renseignement $renseignement): Response
    {
        return $this->render('Backoffice/renseignement/show.html.twig', [
            'renseignement' => $renseignement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="renseignement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Renseignement $renseignement): Response
    {
        $form = $this->createForm(RenseignementType::class, $renseignement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $renseignement->setDateMessage(new DateTime());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('renseignement_index', [
                'id' => $renseignement->getId(),
            ]);
        }

        return $this->render('Backoffice/renseignement/edit.html.twig', [
            'renseignement' => $renseignement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="renseignement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Renseignement $renseignement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$renseignement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($renseignement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('renseignement_index');
    }
}
