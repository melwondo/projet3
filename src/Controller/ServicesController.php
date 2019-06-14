<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Message;
use App\Entity\Service;
use App\Form\ContactType;
use App\Form\MessageType;
use App\Entity\DetailService;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\ServiceRepository;
use App\Repository\DetailServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServicesController extends AbstractController
{
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
       
        $client = new Client();
        $form2 = $this->createForm(ContactType::class, $client);
        $form2->handleRequest($request);

        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $form2->isSubmitted() && $form2->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message, $client);
            $entityManager->flush();
            // return $this->redirectToRoute('service_detail');
        }

        return $this->render('services/details.html.twig', [
            'details' => $detail_service,
            'service' => $service,
            'form' => $form->createView(),
            'form2' => $form2->createView(),
        ]);
         // 'form2' => $form2->createView(),
    }
}
