<?php

namespace App\Entity;

use App\Repository\ValoracionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ValoracionRepository::class)]
#[Broadcast]
class Valoracion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?UserTour $cod_reserva = null;

    #[ORM\Column]
    private ?int $nota_guia = null;

    #[ORM\Column]
    private ?int $nota_ruta = null;

    #[ORM\Column(length: 255)]
    private ?string $comentario = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodReserva(): ?UserTour
    {
        return $this->cod_reserva;
    }

    public function setCodReserva(?UserTour $cod_reserva): static
    {
        $this->cod_reserva = $cod_reserva;

        return $this;
    }

    public function getNotaGuia(): ?int
    {
        return $this->nota_guia;
    }

    public function setNotaGuia(int $nota_guia): static
    {
        $this->nota_guia = $nota_guia;

        return $this;
    }

    public function getNotaRuta(): ?int
    {
        return $this->nota_ruta;
    }

    public function setNotaRuta(int $nota_ruta): static
    {
        $this->nota_ruta = $nota_ruta;

        return $this;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(string $comentario): static
    {
        $this->comentario = $comentario;

        return $this;
    }
}
