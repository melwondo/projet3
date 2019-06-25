<?php

namespace App\Controller;

use App\Entity\Service;
use Nette\Utils\DateTime;
use App\Entity\DetailService;
use App\Entity\Renseignement;
use App\Form\RenseignementType;
use App\Repository\ServiceRepository;
use App\Repository\DetailServiceRepository;
use Symfony\Component\HttpFoundation\Request;
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
     */
    public function index(ServiceRepository $service)
    {
        $services = $service->findBy(['visible'=>1]);

        return $this->render('services/index.html.twig', [
            'services' => $services
        ]);
    }



    /**
     * @Route("/services/{id}", name="service_detail")
     */
    public function details(Request $request, Service $service, DetailServiceRepository $detail_service)
    {

        $detail_service = $detail_service ->findBy(['service'=>$service->getId()]);
       
        $client = new Renseignement();
        $form = $this->createForm(RenseignementType::class, $client);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $client->setDateMessage(new DateTime());

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
