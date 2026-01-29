<?php

namespace App\Entity;

use App\Repository\MundoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MundoRepository::class)]
class Mundo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $dificultad = null;

    #[ORM\Column]
    private ?int $orden = null;

    /**
     * @var Collection<int, Nivel>
     */
    #[ORM\OneToMany(targetEntity: Nivel::class, mappedBy: 'mundo', orphanRemoval: true)]
    private Collection $nivels;

    public function __construct()
    {
        $this->nivels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDificultad(): ?string
    {
        return $this->dificultad;
    }

    public function setDificultad(string $dificultad): static
    {
        $this->dificultad = $dificultad;

        return $this;
    }

    public function getOrden(): ?int
    {
        return $this->orden;
    }

    public function setOrden(int $orden): static
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * @return Collection<int, Nivel>
     */
    public function getNivels(): Collection
    {
        return $this->nivels;
    }

    public function addNivel(Nivel $nivel): static
    {
        if (!$this->nivels->contains($nivel)) {
            $this->nivels->add($nivel);
            $nivel->setMundo($this);
        }

        return $this;
    }

    public function removeNivel(Nivel $nivel): static
    {
        if ($this->nivels->removeElement($nivel)) {
            // set the owning side to null (unless already changed)
            if ($nivel->getMundo() === $this) {
                $nivel->setMundo(null);
            }
        }

        return $this;
    }
}
