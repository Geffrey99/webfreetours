<?php

namespace App\Entity;

use App\Repository\RutaVisitaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: RutaVisitaRepository::class)]
#[Broadcast]
class RutaVisita
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'rutaVisitas')]
    private ?Ruta $cod_ruta = null;

    #[ORM\ManyToOne(inversedBy: 'rutaVisitas')]
    private ?Visita $cod_visita = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodRuta(): ?Ruta
    {
        return $this->cod_ruta;
    }

    public function setCodRuta(?Ruta $cod_ruta): static
    {
        $this->cod_ruta = $cod_ruta;

        return $this;
    }

    public function getCodVisita(): ?Visita
    {
        return $this->cod_visita;
    }

    public function setCodVisita(?Visita $cod_visita): static
    {
        $this->cod_visita = $cod_visita;

        return $this;
    }
}
