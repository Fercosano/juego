<?php

namespace App\Entity;

use App\Repository\ProgresoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgresoRepository::class)]
class Progreso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $puntuacion = null;

    #[ORM\Column]
    private ?\DateTime $fechaCompletado = null;

    #[ORM\ManyToOne(inversedBy: 'progresos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuario = null;

    #[ORM\ManyToOne(inversedBy: 'progresos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Nivel $nivel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPuntuacion(): ?int
    {
        return $this->puntuacion;
    }

    public function setPuntuacion(int $puntuacion): static
    {
        $this->puntuacion = $puntuacion;

        return $this;
    }

    public function getFechaCompletado(): ?\DateTime
    {
        return $this->fechaCompletado;
    }

    public function setFechaCompletado(\DateTime $fechaCompletado): static
    {
        $this->fechaCompletado = $fechaCompletado;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getNivel(): ?Nivel
    {
        return $this->nivel;
    }

    public function setNivel(?Nivel $nivel): static
    {
        $this->nivel = $nivel;

        return $this;
    }
}
