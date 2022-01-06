<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 */
class Formation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nomCourt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomLong;

    /**
     * @ORM\ManyToMany(targetEntity=Stage::class, inversedBy="formations")
     */
    private $listeStages;

    public function __construct()
    {
        $this->listeStages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCourt(): ?string
    {
        return $this->nomCourt;
    }

    public function setNomCourt(string $nomCourt): self
    {
        $this->nomCourt = $nomCourt;

        return $this;
    }

    public function getNomLong(): ?string
    {
        return $this->nomLong;
    }

    public function setNomLong(string $nomLong): self
    {
        $this->nomLong = $nomLong;

        return $this;
    }

    /**
     * @return Collection|Stage[]
     */
    public function getListeStages(): Collection
    {
        return $this->listeStages;
    }

    public function addListeStage(Stage $listeStage): self
    {
        if (!$this->listeStages->contains($listeStage)) {
            $this->listeStages[] = $listeStage;
        }

        return $this;
    }

    public function removeListeStage(Stage $listeStage): self
    {
        $this->listeStages->removeElement($listeStage);

        return $this;
    }
}
