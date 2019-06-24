<?php

namespace App\Controller;

use App\Entity\DetailService;
use App\Form\DetailServiceType;
use App\Repository\DetailServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/detail/service")
 */
class DetailServiceController extends AbstractController
{
    /**
     * @Route("/", name="detail_service_index", methods={"GET"})
     */
    public function index(DetailServiceRepository $detailServiceRepository): Response
    {
        return $this->render('detail_service/index.html.twig', [
            'detail_services' => $detailServiceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="detail_service_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $detailService = new DetailService();
        $form = $this->createForm(DetailServiceType::class, $detailService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($detailService);
            $entityManager->flush();

            return $this->redirectToRoute('detail_service_index');
        }

        return $this->render('detail_service/new.html.twig', [
            'detail_service' => $detailService,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="detail_service_show", methods={"GET"})
     */
    public function show(DetailService $detailService): Response
    {
        return $this->render('detail_service/show.html.twig', [
            'detail_service' => $detailService,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="detail_service_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DetailService $detailService): Response
    {
        $form = $this->createForm(DetailServiceType::class, $detailService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('detail_service_index', [
                'id' => $detailService->getId(),
            ]);
        }

        return $this->render('detail_service/edit.html.twig', [
            'detail_service' => $detailService,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="detail_service_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DetailService $detailService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detailService->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($detailService);
            $entityManager->flush();
        }

        return $this->redirectToRoute('detail_service_index');
    }
}