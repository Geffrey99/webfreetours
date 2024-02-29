<?php

namespace App\Entity;

use App\Repository\RutaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column(type: "json")]
    private ?array $programacion = null;

    #[ORM\OneToMany(mappedBy: 'cod_ruta', targetEntity: RutaVisita::class)]
    private Collection $rutaVisitas;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_inicio = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_fin = null;

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

    public function getProgramacion(): ?array
    {
        return $this->programacion;
    }
    
    public function setProgramacion(array $programacion): static
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

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fecha_inicio;
    }

    public function setFechaInicio(\DateTimeInterface $fecha_inicio): static
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fecha_fin;
    }

    public function setFechaFin(\DateTimeInterface $fecha_fin): static
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    // En tu entidad Ruta
public function __toString(): string
{
    // Suponiendo que 'nombre' es la propiedad que quieres mostrar
    return $this->nombre;
}

// public function serializeToJson(): string
// {
//     $data = [
//         'id' => $this->id,
//         'nombre' => $this->nombre,
//         'descripcion' => $this->descripcion,
//         'foto' => $this->foto,
//         'punto_inicio' => $this->punto_inicio,
//         'participantes' => $this->participantes,
//         'programacion' => $this->programacion,
//         'fecha_inicio' => $this->fecha_inicio,
//         'fecha_fin' => $this->fecha_fin,
//         // ... (other properties)
//     ];

//     return json_encode($data);
// }

// // Deserialize the entity
// public function unserialize(string $data): void
// {
//     $values = unserialize($data);
//     $this->id = $values['id'];
//     $this->nombre = $values['nombre'];
//     $this->descripcion = $values['descripcion'];
//     $this->foto = $values['foto'];
//     $this->punto_inicio = $values['punto_inicio'];
//     $this->participantes = $values['participantes'];
//     $this->programacion = $values['programacion'];
//     $this->fecha_inicio = $values['fecha_inicio'];
//     $this->fecha_fin = $values['fecha_fin'];
//     // ... (other properties)
// }


}
