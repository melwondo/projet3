<?php

namespace App\Controller\Backoffice;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Form\ServiceEditType;
use App\Repository\ServiceRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\MimeType\ExtensionGuesser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Require ROLE_ADMIN for *every* controller method in this class.
 *
 * @IsGranted("ROLE_ADMIN")
 *
 * @Route("/service")
 */
class ServiceController extends AbstractController
{
    /**
     * @Route("/", name="service_index", methods={"GET"})
     * @param ServiceRepository $serviceRepository
     * @return Response
     */
    public function index(ServiceRepository $serviceRepository): Response
    {
        return $this->render('Backoffice/service/index.html.twig', [
            'services' => $serviceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="service_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     * @see guessExtension()
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form['url_img']->getData();
            if (!empty($imageFile)) {
                $imageFileName = $fileUploader->uploadImgService($imageFile);
                $service->setUrlImg($imageFileName);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($service);
            $entityManager->flush();

            return $this->redirectToRoute('service_index');
        }

        return $this->render('Backoffice/service/new.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="service_show", methods={"GET"})
     * @param Service $service
     * @return Response
     */
    public function show(Service $service): Response
    {
        return $this->render('Backoffice/service/show.html.twig', [
            'service' => $service,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="service_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Service $service
     * @return Response
     */
    public function edit(Request $request, Service $service, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(ServiceEditType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form['url_img']->getData();
            if (!empty($imageFile)) {
                $imageFileName = $fileUploader->uploadImgService($imageFile);
                $service->setUrlImg($imageFileName);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('service_index', [
                'id' => $service->getId(),
            ]);
        }

        return $this->render('Backoffice/service/edit.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="service_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Service $service): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($service);
            $entityManager->flush();
        }

        return $this->redirectToRoute('service_index');
    }
}
