<?php

namespace App\Controller\Backoffice;

use App\Entity\ContactSimple;
use App\Form\ContactType;
use App\Repository\ContactSimpleRepository;
use Nette\Utils\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Require ROLE_ADMIN for *every* controller method in this class.
 *
 * @IsGranted("ROLE_ADMIN")
 *
 * @Route("/renseignement")
 */
class RenseignementController extends AbstractController
{
    /**
     * @Route("/", name="renseignement_index", methods={"GET"})
     */
    public function index(ContactSimpleRepository $contactSimpleRepository): Response
    {
        return $this->render('Backoffice/renseignement/index.html.twig', [
            'contactsSimples' => $contactSimpleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/Contact", name="contactSimple_new", methods={"GET","POST"})
     */
    public function newContactSimple(Request $request): Response
    {
        $contactSimple = new ContactSimple();
        $form = $this->createForm(ContactType::class, $contactSimple);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactSimple->setDateMessage(new DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contactSimple);
            $entityManager->flush();

            return $this->redirectToRoute('renseignement_index');
        }

        return $this->render('Backoffice/renseignement/newContactSimple.html.twig', [
            'contactSimple' => $contactSimple,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contact/{id}", name="contactSimple_show", methods={"GET"})
     */
    public function showContact(ContactSimple $contactSimple): Response
    {
        return $this->render('Backoffice/renseignement/showContactSimple.html.twig', [
            'contactSimple' => $contactSimple,
        ]);
    }

    /**
     * @Route("/{id}/editContact", name="contactSimple_edit", methods={"GET","POST"})
     */
    public function editContact(Request $request, ContactSimple $contactSimple): Response
    {
        $form = $this->createForm(ContactType::class, $contactSimple);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactSimple->setDateMessage(new DateTime());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('renseignement_index', [
                'id' => $contactSimple->getId(),
            ]);
        }

        return $this->render('Backoffice/renseignement/editContactSimple.html.twig', [
            'contactSimple' => $contactSimple,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contact/{id}", name="contactSimple_delete", methods={"DELETE"})
     */
    public function deleteContact(Request $request, ContactSimple $contactSimple): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contactSimple->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contactSimple);
            $entityManager->flush();
        }

        return $this->redirectToRoute('renseignement_index');
    }
}
