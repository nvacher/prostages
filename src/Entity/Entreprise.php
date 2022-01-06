<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $activite;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $siteweb;

    /**
     * @ORM\OneToMany(targetEntity=Stage::class, mappedBy="entreprise")
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(string $activite): self
    {
        $this->activite = $activite;

        return $this;
    }

    public function getSiteweb(): ?string
    {
        return $this->siteweb;
    }

    public function setSiteweb(string $siteweb): self
    {
        $this->siteweb = $siteweb;

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
            $listeStage->setEntreprise($this);
        }

        return $this;
    }

    public function removeListeStage(Stage $listeStage): self
    {
        if ($this->listeStages->removeElement($listeStage)) {
            // set the owning side to null (unless already changed)
            if ($listeStage->getEntreprise() === $this) {
                $listeStage->setEntreprise(null);
            }
        }

        return $this;
    }
}
