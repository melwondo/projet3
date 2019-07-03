<?php

namespace App\Controller;

use App\Entity\Service;
use Exception;
use Nette\Utils\DateTime;
use App\Entity\DetailService;
use App\Entity\Renseignement;
use App\Form\RenseignementType;
use App\Repository\ServiceRepository;
use App\Repository\DetailServiceRepository;
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
     * @param ServiceRepository $service
     * @return Response
     */
    public function index(ServiceRepository $service)
    {
        $services = $service->findBy(['visible'=>1]);

        return $this->render('services/index.html.twig', [
            'services' => $services,
        ]);
    }


    /**
     * @Route("/services/{id}", name="service_detail")
     * @param Request $request
     * @param Service $service
     * @param DetailServiceRepository $detail_service
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function details(Request $request, Service $service, DetailServiceRepository $detail_service)
    {

        $detail_service = $detail_service ->findBy(['service'=>$service->getId(), 'visible'=> 1]);
       
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
