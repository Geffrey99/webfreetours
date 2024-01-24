<?php

namespace App\Entity;

use App\Repository\UserTourRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: UserTourRepository::class)]
#[Broadcast]
class UserTour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userTours')]
    private ?User $cod_user = null;

    #[ORM\ManyToOne(inversedBy: 'userTours')]
    private ?Tour $cod_tour = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_reserva = null;

    #[ORM\Column]
    private ?int $asistentes = null;

    #[ORM\Column]
    private ?int $num_gente_reserva = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodUser(): ?User
    {
        return $this->cod_user;
    }

    public function setCodUser(?User $cod_user): static
    {
        $this->cod_user = $cod_user;

        return $this;
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

    public function getFechaReserva(): ?\DateTimeInterface
    {
        return $this->fecha_reserva;
    }

    public function setFechaReserva(\DateTimeInterface $fecha_reserva): static
    {
        $this->fecha_reserva = $fecha_reserva;

        return $this;
    }

    public function getAsistentes(): ?int
    {
        return $this->asistentes;
    }

    public function setAsistentes(int $asistentes): static
    {
        $this->asistentes = $asistentes;

        return $this;
    }

    public function getNumGenteReserva(): ?int
    {
        return $this->num_gente_reserva;
    }

    public function setNumGenteReserva(int $num_gente_reserva): static
    {
        $this->num_gente_reserva = $num_gente_reserva;

        return $this;
    }
}
