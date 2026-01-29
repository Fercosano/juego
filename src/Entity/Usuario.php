<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nickname = null;

    #[ORM\ManyToOne(inversedBy: 'usuarios')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rol $rol = null;

    /**
     * @var Collection<int, Progreso>
     */
    #[ORM\OneToMany(targetEntity: Progreso::class, mappedBy: 'usuario', orphanRemoval: true)]
    private Collection $progresos;

    public function __construct()
    {
        $this->progresos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): static
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getRol(): ?Rol
    {
        return $this->rol;
    }

    public function setRol(?Rol $rol): static
    {
        $this->rol = $rol;

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
            $progreso->setUsuario($this);
        }

        return $this;
    }

    public function removeProgreso(Progreso $progreso): static
    {
        if ($this->progresos->removeElement($progreso)) {
            // set the owning side to null (unless already changed)
            if ($progreso->getUsuario() === $this) {
                $progreso->setUsuario(null);
            }
        }

        return $this;
    }
}
