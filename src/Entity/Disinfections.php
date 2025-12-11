<?php

namespace App\Entity;

use App\Repository\DisinfectionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DisinfectionsRepository::class)]
class Disinfections
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date = null;

    #[ORM\ManyToOne(inversedBy: 'disinfections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vehicle $vehicle_id = null;

    #[ORM\Column(length: 255)]
    private ?string $disinfectionType = null;

    #[ORM\ManyToOne(inversedBy: 'disinfections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getVehicleId(): ?Vehicle
    {
        return $this->vehicle_id;
    }

    public function setVehicleId(?Vehicle $vehicle_id): static
    {
        $this->vehicle_id = $vehicle_id;

        return $this;
    }

    public function getDisinfectionType(): ?string
    {
        return $this->disinfectionType;
    }

    public function setDisinfectionType(string $disinfectionType): static
    {
        $this->disinfectionType = $disinfectionType;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }
}
