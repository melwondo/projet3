<?php


namespace App\Controller;

use App\Repository\ContactSimpleRepository as CSRepo;
use App\Repository\RenseignementRepository as RRepo;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Require ROLE_ADMIN for *every* controller method in this class.
 *
 * @IsGranted("ROLE_ADMIN")
 **/
class XlsController extends AbstractController
{
    /**
     * @Route("/exportXlsRenseignement", name="xls_export_renseignement")
     */
    public function exportRenseignementXLS(RRepo $renseignementRepository)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Pro');
        $sheet->setCellValue('C1', 'Entreprise');
        $sheet->setCellValue('D1', 'Nom');
        $sheet->setCellValue('E1', 'Prenom');
        $sheet->setCellValue('F1', 'Email');
        $sheet->setCellValue('G1', 'Telephone');
        $sheet->setCellValue('H1', 'rue');
        $sheet->setCellValue('I1', 'CP');
        $sheet->setCellValue('J1', 'Ville');

        $renseignements = $renseignementRepository->findAll();

        $i = 2;
        foreach ($renseignements as $renseignement) {
            $sheet->setCellValue('A'.$i, $renseignement->getid());
            $sheet->setCellValue('B'.$i, $renseignement->getPro() ? 'Pro' : 'Particulier');
            $sheet->setCellValue('C'.$i, $renseignement->getEntreprise());
            $sheet->setCellValue('D'.$i, $renseignement->getNom());
            $sheet->setCellValue('E'.$i, $renseignement->getPrenom());
            $sheet->setCellValue('F'.$i, $renseignement->getEmail());
            $sheet->setCellValue('G'.$i, $renseignement->getTel());
            $sheet->setCellValue('H'.$i, $renseignement->getRue());
            $sheet->setCellValue('I'.$i, $renseignement->getCp());
            $sheet->setCellValue('J'.$i, $renseignement->getVille());

            $i++;
        }

        $fichier = 'contactRenseignement.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($fichier);


        $chemin = "./" ;
        $response = new Response();
        $response->setContent(file_get_contents($chemin.$fichier));
        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-disposition', 'filename='. $fichier);
        return $response;
    }




    /**
     * @Route("/exportXlsContactSimple", name="xls_export_contactSimple")
     */
    public function exportContactSimpleXLS(CSRepo $contactSimpleRepository)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Pro');
        $sheet->setCellValue('C1', 'Entreprise');
        $sheet->setCellValue('D1', 'Nom');
        $sheet->setCellValue('E1', 'Prenom');
        $sheet->setCellValue('F1', 'Email');
        $sheet->setCellValue('G1', 'Telephone');
        $sheet->setCellValue('H1', 'rue');
        $sheet->setCellValue('I1', 'CP');
        $sheet->setCellValue('J1', 'Ville');


        $contactsSimples = $contactSimpleRepository->findAll();
        $i = 2;
        foreach ($contactsSimples as $contactSimple) {
            $sheet->setCellValue('A'.$i, $contactSimple->getid());
            $sheet->setCellValue('B'.$i, $contactSimple->getPro() ? 'Pro' : 'Particulier');
            $sheet->setCellValue('C'.$i, $contactSimple->getEntreprise());
            $sheet->setCellValue('D'.$i, $contactSimple->getNom());
            $sheet->setCellValue('E'.$i, $contactSimple->getPrenom());
            $sheet->setCellValue('F'.$i, $contactSimple->getEmail());
            $sheet->setCellValue('G'.$i, $contactSimple->getTel());
            $sheet->setCellValue('H'.$i, $contactSimple->getRue());
            $sheet->setCellValue('I'.$i, $contactSimple->getCp());
            $sheet->setCellValue('J'.$i, $contactSimple->getVille());

            $i++;
        }

        $fichier = 'contactMessage.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($fichier);

        $chemin = "./" ;
        $response = new Response();
        $response->setContent(file_get_contents($chemin.$fichier));
        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-disposition', 'filename='. $fichier);
        return $response;
    }

    /**
     * @Route("/exportXlsAll", name="xls_export_all")
     */
    public function exportAllContactXLS(RRepo $renseignementRepository, CSRepo $contactSimpleRepository)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Pro');
        $sheet->setCellValue('C1', 'Entreprise');
        $sheet->setCellValue('D1', 'Nom');
        $sheet->setCellValue('E1', 'Prenom');
        $sheet->setCellValue('F1', 'Email');
        $sheet->setCellValue('G1', 'Telephone');
        $sheet->setCellValue('H1', 'rue');
        $sheet->setCellValue('I1', 'CP');
        $sheet->setCellValue('J1', 'Ville');


        $renseignements = $renseignementRepository->findAll();
        $contactsSimples = $contactSimpleRepository->findAll();

        $i = 2;
        foreach ($renseignements as $renseignement) {
            $sheet->setCellValue('A'.$i, $renseignement->getid());
            $sheet->setCellValue('B'.$i, $renseignement->getPro() ? 'Pro' : 'Particulier');
            $sheet->setCellValue('C'.$i, $renseignement->getEntreprise());
            $sheet->setCellValue('D'.$i, $renseignement->getNom());
            $sheet->setCellValue('E'.$i, $renseignement->getPrenom());
            $sheet->setCellValue('F'.$i, $renseignement->getEmail());
            $sheet->setCellValue('G'.$i, $renseignement->getTel());
            $sheet->setCellValue('H'.$i, $renseignement->getRue());
            $sheet->setCellValue('I'.$i, $renseignement->getCp());
            $sheet->setCellValue('J'.$i, $renseignement->getVille());

            $i++;
        }

        foreach ($contactsSimples as $contactSimple) {
            $sheet->setCellValue('A'.$i, $contactSimple->getid());
            $sheet->setCellValue('B'.$i, $contactSimple->getPro() ? 'Pro' : 'Particulier');
            $sheet->setCellValue('C'.$i, $contactSimple->getEntreprise());
            $sheet->setCellValue('D'.$i, $contactSimple->getNom());
            $sheet->setCellValue('E'.$i, $contactSimple->getPrenom());
            $sheet->setCellValue('F'.$i, $contactSimple->getEmail());
            $sheet->setCellValue('G'.$i, $contactSimple->getTel());
            $sheet->setCellValue('H'.$i, $contactSimple->getRue());
            $sheet->setCellValue('I'.$i, $contactSimple->getCp());
            $sheet->setCellValue('J'.$i, $contactSimple->getVille());

            $i++;
        }

        $fichier = 'AllContact.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($fichier);

        $chemin = "./" ;
        $response = new Response();
        $response->setContent(file_get_contents($chemin.$fichier));
        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-disposition', 'filename='. $fichier);
        return $response;
    }
}
