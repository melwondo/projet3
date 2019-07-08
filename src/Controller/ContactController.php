<?php

namespace App\Controller;

use App\Entity\ContactSimple;
use App\Entity\GestionPage;
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
    public function index(Request $request, \Swift_Mailer $mailer)
    {

        $blocsPage = $this->getDoctrine()
            ->getRepository(GestionPage::class)
            ->findBy(['PageAssociee'=>'Contact']);


        $contact = new ContactSimple();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eM = $this->getDoctrine()->getManager();
            $contact->setDateMessage(new DateTime());
            
            $tete = $contact->getNom(). ' ' . $contact->getPrenom();
            $message = (new \Swift_Message())
            ->setSubject($tete)
            ->setFrom($this->getParameter('mailer_from'))
            ->setTo('hhggaamlk@gmail.com')
            ->setBody(
                $this->renderView(
                    'Email/notificationContact.html.twig',
                    ['client' => $contact]
                ),
                'text/html'
            );
            
            $mailer->send($message);

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
            'blocs'=> $blocsPage,
        ]);
    }
}
