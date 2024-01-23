<?php

namespace App\Entity;

use App\Repository\RutaVisitaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'rutaVisita', targetEntity: Ruta::class)]
    private Collection $cod_ruta;

    #[ORM\OneToMany(mappedBy: 'rutaVisita', targetEntity: Visita::class)]
    private Collection $cod_visita;

    public function __construct()
    {
        $this->cod_ruta = new ArrayCollection();
        $this->cod_visita = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Ruta>
     */
    public function getCodRuta(): Collection
    {
        return $this->cod_ruta;
    }

    public function addCodRutum(Ruta $codRutum): static
    {
        if (!$this->cod_ruta->contains($codRutum)) {
            $this->cod_ruta->add($codRutum);
            $codRutum->setRutaVisita($this);
        }

        return $this;
    }

    public function removeCodRutum(Ruta $codRutum): static
    {
        if ($this->cod_ruta->removeElement($codRutum)) {
            // set the owning side to null (unless already changed)
            if ($codRutum->getRutaVisita() === $this) {
                $codRutum->setRutaVisita(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Visita>
     */
    public function getCodVisita(): Collection
    {
        return $this->cod_visita;
    }

    public function addCodVisitum(Visita $codVisitum): static
    {
        if (!$this->cod_visita->contains($codVisitum)) {
            $this->cod_visita->add($codVisitum);
            $codVisitum->setRutaVisita($this);
        }

        return $this;
    }

    public function removeCodVisitum(Visita $codVisitum): static
    {
        if ($this->cod_visita->removeElement($codVisitum)) {
            // set the owning side to null (unless already changed)
            if ($codVisitum->getRutaVisita() === $this) {
                $codVisitum->setRutaVisita(null);
            }
        }

        return $this;
    }
}
