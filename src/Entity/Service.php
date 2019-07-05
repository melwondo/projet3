<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class Service
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $subtitle;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="text")
     */
    private $url_img;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetailService", mappedBy="service", orphanRemoval=true)
     */
    private $detailServices;

    public function __construct()
    {
        $this->detailServices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getUrlImg(): ?string
    {
        return $this->url_img;
    }

    public function setUrlImg(string $url_img): self
    {
        $this->url_img = $url_img;

        return $this;
    }

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * @return Collection|DetailService[]
     */
    public function getDetailServices(): Collection
    {
        return $this->detailServices;
    }

    public function addDetailService(DetailService $detailService): self
    {
        if (!$this->detailServices->contains($detailService)) {
            $this->detailServices[] = $detailService;
            $detailService->setService($this);
        }

        return $this;
    }

    public function removeDetailService(DetailService $detailService): self
    {
        if ($this->detailServices->contains($detailService)) {
            $this->detailServices->removeElement($detailService);
            // set the owning side to null (unless already changed)
            if ($detailService->getService() === $this) {
                $detailService->setService(null);
            }
        }

        return $this;
    }
}
