<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDirectorySousService;
    private $targetDirectoryService;
    private $targetDirectoryPartenaire;
    private $targetDirectoryPage;

    public function __construct(
        $targetDirectorySousService,
        $targetDirectoryService,
        $targetDirectoryPartenaire,
        $targetDirectoryPage
    ) {
        $this->targetDirectorySousService = $targetDirectorySousService;
        $this->targetDirectoryService = $targetDirectoryService;
        $this->targetDirectoryPartenaire = $targetDirectoryPartenaire;
        $this->targetDirectoryPage = $targetDirectoryPage;
    }

    public function uploadImgSousService(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = transliterator_transliterate(
            'Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',
            $originalFilename
        );
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectorySousService(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    public function uploadImgService(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = transliterator_transliterate(
            'Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',
            $originalFilename
        );
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectoryService(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    public function uploadImgPartenaire(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = transliterator_transliterate(
            'Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',
            $originalFilename
        );
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectoryPartenaire(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }


    public function uploadImgPage(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = transliterator_transliterate(
            'Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',
            $originalFilename
        );
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectoryPage(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }


    /**
     * @return mixed
     */
    public function getTargetDirectorySousService()
    {
        return $this->targetDirectorySousService;
    }

    /**
     * @return mixed
     */
    public function getTargetDirectoryService()
    {
        return $this->targetDirectoryService;
    }


    /**
     * @return mixed
     */
    public function getTargetDirectoryPartenaire()
    {
        return $this->targetDirectoryPartenaire;
    }

    /**
     * @return mixed
     */
    public function getTargetDirectoryPage()
    {
        return $this->targetDirectoryPage;
    }
}
