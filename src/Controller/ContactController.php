<?php

namespace App\Controller;

use App\Entity\ContactSimple;
use App\Entity\Service;
use App\Form\ContactType;
use Nette\Utils\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $contact = new ContactSimple();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eM = $this->getDoctrine()->getManager();
            $contact->setDateMessage(new DateTime());

            $this->addFlash(
                'notice',
                'Votre message a bien été envoyé !'
            );

            $eM->persist($contact);
            $eM->flush();

            return $this->redirect($request->getUri());
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form -> createView(),
        ]);
    }
}
