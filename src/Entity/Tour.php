<?php

namespace App\Entity;

use App\Repository\TourRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: TourRepository::class)]
#[Broadcast]
class Tour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_hora = null;

    #[ORM\ManyToOne(inversedBy: 'tours')]
    private ?Ruta $cod_ruta = null;

    #[ORM\OneToMany(mappedBy: 'cod_tour', targetEntity: UserTour::class)]
    private Collection $userTours;

    public function __construct()
    {
        $this->userTours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaHora(): ?\DateTimeInterface
    {
        return $this->fecha_hora;
    }

    public function setFechaHora(\DateTimeInterface $fecha_hora): static
    {
        $this->fecha_hora = $fecha_hora;

        return $this;
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

    /**
     * @return Collection<int, UserTour>
     */
    public function getUserTours(): Collection
    {
        return $this->userTours;
    }

    public function addUserTour(UserTour $userTour): static
    {
        if (!$this->userTours->contains($userTour)) {
            $this->userTours->add($userTour);
            $userTour->setCodTour($this);
        }

        return $this;
    }

    public function removeUserTour(UserTour $userTour): static
    {
        if ($this->userTours->removeElement($userTour)) {
            // set the owning side to null (unless already changed)
            if ($userTour->getCodTour() === $this) {
                $userTour->setCodTour(null);
            }
        }

        return $this;
    }
}
