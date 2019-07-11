<?php

namespace App\Controller\Backoffice;

use App\Entity\GestionPage;
use App\Form\GestionPageType;
use App\Form\GestionPageEditType;
use App\Repository\GestionPageRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Require ROLE_ADMIN for *every* controller method in this class.
 *
 * @IsGranted("ROLE_ADMIN")
 *
 * @Route("/gestion/page")
 */
class GestionPageController extends AbstractController
{
    /**
     * @Route("/", name="gestion_page_index", methods={"GET"})
     */
    public function index(GestionPageRepository $gestionPageRepository): Response
    {
        return $this->render('Backoffice/gestion_page/index.html.twig', [
            'gestion_pages' => $gestionPageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="gestion_page_new", methods={"GET","POST"})
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $gestionPage = new GestionPage();
        $form = $this->createForm(GestionPageType::class, $gestionPage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form['Image']->getData();
            if (!empty($imageFile)) {
                $imageFileName = $fileUploader->uploadImgPage($imageFile);
                $gestionPage->setImage($imageFileName);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gestionPage);
            $entityManager->flush();

            return $this->redirectToRoute('gestion_page_index');
        }

        return $this->render('Backoffice/gestion_page/new.html.twig', [
            'gestion_page' => $gestionPage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gestion_page_show", methods={"GET"})
     */
    public function show(GestionPage $gestionPage): Response
    {
        return $this->render('Backoffice/gestion_page/show.html.twig', [
            'gestion_page' => $gestionPage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gestion_page_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, GestionPage $gestionPage, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(GestionPageEditType::class, $gestionPage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form['Image']->getData();
            if (!empty($imageFile)) {
                $imageFileName = $fileUploader->uploadImgPage($imageFile);
                $gestionPage->setImage($imageFileName);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gestion_page_index', [
                'id' => $gestionPage->getId(),
            ]);
        }

        return $this->render('Backoffice/gestion_page/edit.html.twig', [
            'gestion_page' => $gestionPage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gestion_page_delete", methods={"DELETE"})
     */
    public function delete(Request $request, GestionPage $gestionPage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gestionPage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gestionPage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gestion_page_index');
    }
}
