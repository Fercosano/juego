<?php

namespace App\Entity;

use App\Repository\NivelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NivelRepository::class)]
class Nivel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column]
    private array $mapa_json = [];

    #[ORM\ManyToOne(inversedBy: 'nivels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mundo $mundo = null;

    /**
     * @var Collection<int, Progreso>
     */
    #[ORM\OneToMany(targetEntity: Progreso::class, mappedBy: 'nivel', orphanRemoval: true)]
    private Collection $progresos;

    public function __construct()
    {
        $this->progresos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getMapaJson(): array
    {
        return $this->mapa_json;
    }

    public function setMapaJson(array $mapa_json): static
    {
        $this->mapa_json = $mapa_json;

        return $this;
    }

    public function getMundo(): ?Mundo
    {
        return $this->mundo;
    }

    public function setMundo(?Mundo $mundo): static
    {
        $this->mundo = $mundo;

        return $this;
    }

    /**
     * @return Collection<int, Progreso>
     */
    public function getProgresos(): Collection
    {
        return $this->progresos;
    }

    public function addProgreso(Progreso $progreso): static
    {
        if (!$this->progresos->contains($progreso)) {
            $this->progresos->add($progreso);
            $progreso->setNivel($this);
        }

        return $this;
    }

    public function removeProgreso(Progreso $progreso): static
    {
        if ($this->progresos->removeElement($progreso)) {
            // set the owning side to null (unless already changed)
            if ($progreso->getNivel() === $this) {
                $progreso->setNivel(null);
            }
        }

        return $this;
    }
}
