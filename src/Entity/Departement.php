<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartementRepository")
 */
class Departement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Responsable", mappedBy="departement", cascade={"persist"})
     */
    private $responsable;

    public function __construct()
    {
        $this->responsable = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    /**
     * @return Collection|Responsable[]
     */
    public function getResponsable(): Collection
    {
        return $this->responsable;
    }

    public function addResponsable(Responsable $responsable): self
    {
        if (!$this->responsable->contains($responsable)) {
            $this->responsable[] = $responsable;
            $responsable->setDepartement($this);
        }

        return $this;
    }

    public function removeResponsable(Responsable $responsable): self
    {
        if ($this->responsable->contains($responsable)) {
            $this->responsable->removeElement($responsable);
            // set the owning side to null (unless already changed)
            if ($responsable->getDepartement() === $this) {
                $responsable->setDepartement(null);
            }
        }

        return $this;
    }
}
