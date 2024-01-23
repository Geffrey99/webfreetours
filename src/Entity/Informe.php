<?php

namespace App\Entity;

use App\Repository\InformeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: InformeRepository::class)]
#[Broadcast]
class Informe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Tour $cod_tour = null;

    #[ORM\Column(length: 255)]
    private ?string $imagen = null;

    #[ORM\Column(length: 255)]
    private ?string $observaciones = null;

    #[ORM\Column]
    private ?int $recaudacion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodTour(): ?Tour
    {
        return $this->cod_tour;
    }

    public function setCodTour(?Tour $cod_tour): static
    {
        $this->cod_tour = $cod_tour;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): static
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): static
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function getRecaudacion(): ?int
    {
        return $this->recaudacion;
    }

    public function setRecaudacion(int $recaudacion): static
    {
        $this->recaudacion = $recaudacion;

        return $this;
    }
}
