<?php

namespace App\Controller;

use App\Entity\Service;
use Exception;
use Nette\Utils\DateTime;
use App\Entity\DetailService;
use App\Entity\Renseignement;
use App\Form\RenseignementType;
use App\Repository\ServiceRepository;
use App\Repository\DetailServiceRepository as details;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServicesController extends AbstractController
{

    public function __construct()
    {
        date_default_timezone_set("Europe/Paris");
    }

    /**
     * @Route("/services", name="services")
     * @return Response
     */
    public function index(Request $request,
                          ServiceRepository $service,
                          DetailServiceRepository $sousService,
                          \Swift_Mailer $mailer)
    {
        $services = $this->getDoctrine()
            ->getRepository(Service::class)
            ->findBy(['visible'=>1]);

        $sousServices = $sousService->findBy(['visible'=>1]);

        $client = new Renseignement();
        $form = $this->createForm(RenseignementType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $client->setDateMessage(new DateTime());

            $tete = $client->getNom(). ' ' . $client->getPrenom();
            $message = (new \Swift_Message())
            ->setSubject($tete)
            ->setFrom($this->getParameter('mailer_from'))
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


        return $this->render('services/index.html.twig', [
            'services' => $services,
            'sousServices' => $sousServices,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/services/{id}", name="service_detail")
     * @param Request $request
     * @param Service $service
     * @param details $detail_service
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function details(Request $request,
                            Service $service,
                            DetailServiceRepository $detail_service,
                            \Swift_Mailer $mailer)
    {
       
        $detail_service = $detail_service ->findBy(['service'=>$service->getId(), 'visible'=> 1]);
       
        $client = new Renseignement();
        $form = $this->createForm(RenseignementType::class, $client);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $client->setDateMessage(new DateTime());
            
            $tete = $client->getNom(). ' ' . $client->getPrenom();
            $message = (new \Swift_Message())
            ->setSubject($tete)
            ->setFrom($this->getParameter('mailer_from'))
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

        return $this->render('services/details.html.twig', [
            'details' => $detail_service,
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }
}
