<?php

namespace App\Controller;

use App\Entity\ContactSimple;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {

        $contact = new ContactSimple();



        $form=$this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eM = $this->getDoctrine()->getManager();
            $eM->persist($contact);
            $eM->flush();

            return $this->redirect($request->getUri());
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form -> createView()
        ]);
    }
}
