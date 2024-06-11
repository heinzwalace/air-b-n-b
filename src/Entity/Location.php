<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $end = null;

    #[ORM\Column]
    private ?float $day_price = null;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Locataire $locataire = null;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Residence $residence = null;

    #[ORM\Column(nullable: true)]
    private ?float $totalPrice = null;

    #[ORM\Column(nullable: true)]
    private ?int $days = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(?\DateTimeInterface $start): static
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(?\DateTimeInterface $end): static
    {
        $this->end = $end;

        return $this;
    }

    public function getDayPrice(): ?float
    {
        return $this->day_price;
    }

    public function setDayPrice(float $day_price): static
    {
        $this->day_price = $day_price;

        return $this;
    }

    public function getLocataire(): ?Locataire
    {
        return $this->locataire;
    }

    public function setLocataire(?Locataire $locataire): static
    {
        $this->locataire = $locataire;

        return $this;
    }

    public function getResidence(): ?Residence
    {
        return $this->residence;
    }

    public function setResidence(?Residence $residence): static
    {
        $this->residence = $residence;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(?float $totalPrice): static
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getDays(): ?int
    {
        return $this->days;
    }

    public function setDays(?int $days): static
    {
        $this->days = $days;

        return $this;
    }
}
