<?php

namespace App\Entity;

use App\Repository\RutaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: RutaRepository::class)]
#[Broadcast]
class Ruta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255)]
    private ?string $foto = null;

    #[ORM\Column(length: 255)]
    private ?string $punto_inicio = null;

    #[ORM\Column]
    private ?int $participantes = null;

    #[ORM\OneToMany(mappedBy: 'cod_ruta', targetEntity: Tour::class)]
    private Collection $tours;

    #[ORM\Column(length: 255)]
    private ?string $programacion = null;

    #[ORM\OneToMany(mappedBy: 'cod_ruta', targetEntity: RutaVisita::class)]
    private Collection $rutaVisitas;

    public function __construct()
    {
        $this->tours = new ArrayCollection();
        $this->rutaVisitas = new ArrayCollection();
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): static
    {
        $this->foto = $foto;

        return $this;
    }

    public function getPuntoInicio(): ?string
    {
        return $this->punto_inicio;
    }

    public function setPuntoInicio(string $punto_inicio): static
    {
        $this->punto_inicio = $punto_inicio;

        return $this;
    }

    public function getParticipantes(): ?int
    {
        return $this->participantes;
    }

    public function setParticipantes(int $participantes): static
    {
        $this->participantes = $participantes;

        return $this;
    }

    /**
     * @return Collection<int, Tour>
     */
    public function getTours(): Collection
    {
        return $this->tours;
    }

    public function addTour(Tour $tour): static
    {
        if (!$this->tours->contains($tour)) {
            $this->tours->add($tour);
            $tour->setCodRuta($this);
        }

        return $this;
    }

    public function removeTour(Tour $tour): static
    {
        if ($this->tours->removeElement($tour)) {
            // set the owning side to null (unless already changed)
            if ($tour->getCodRuta() === $this) {
                $tour->setCodRuta(null);
            }
        }

        return $this;
    }

    public function getProgramacion(): ?string
    {
        return $this->programacion;
    }

    public function setProgramacion(string $programacion): static
    {
        $this->programacion = $programacion;

        return $this;
    }

    /**
     * @return Collection<int, RutaVisita>
     */
    public function getRutaVisitas(): Collection
    {
        return $this->rutaVisitas;
    }

    public function addRutaVisita(RutaVisita $rutaVisita): static
    {
        if (!$this->rutaVisitas->contains($rutaVisita)) {
            $this->rutaVisitas->add($rutaVisita);
            $rutaVisita->setCodRuta($this);
        }

        return $this;
    }

    public function removeRutaVisita(RutaVisita $rutaVisita): static
    {
        if ($this->rutaVisitas->removeElement($rutaVisita)) {
            // set the owning side to null (unless already changed)
            if ($rutaVisita->getCodRuta() === $this) {
                $rutaVisita->setCodRuta(null);
            }
        }

        return $this;
    }
}
