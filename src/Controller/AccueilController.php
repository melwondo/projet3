<?php

namespace App\Controller;

use App\Entity\Renseignement;
use App\Form\RenseignementType;
use Nette\Utils\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ServiceRepository;
use App\Repository\DetailServiceRepository;
use PHPStan\Symfony\Service;
use App\Repository\PartenaireRepository;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(Request $request, ServiceRepository $service, DetailServiceRepository $sousService, \Swift_Mailer $mailer)
    {
        $services = $service->findBy(['visible'=>1]);
        $sousServices = $sousService->findBy(['visible'=>1]);

        $client = new Renseignement();
        $form = $this->createForm(RenseignementType::class, $client);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $client->setDateMessage(new DateTime());

            $tete = $client->getNom(). ' ' . $client->getPrenom();
            $message = (new \Swift_Message($tete))
            ->setFrom($this->getParameter('mailer_from', 'sendmail'))
            ->setTo('hhggaamlk@gmail.com')
            ->setBody(
                $this->renderView(
                    'Email/notificationRenseignement.html.twig',
                    ['client' => $client]
                ),
                'text/html'
            );

            $mailer->send($message);

            $this->addFlash(
                'notice',
                'Votre message a bien été envoyé !'
            );

            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirect($request->getUri());
        }


        return $this->render('accueil/index.html.twig', [
            'services' => $services,
            'sousServices' => $sousServices,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/accueil/{id}", name="accueil_service")
     */
    public function detail(DetailServiceRepository $detail_service, Service $service)
    {
        $detail_service = $detail_service->findBy(['service' => $service->getId()]);

        return $this->render('services/details.html.twig', [
            'controller_name' => 'ServicesController',
            'details' => $detail_service,
            'service' => $service
        ]);
    }
}
