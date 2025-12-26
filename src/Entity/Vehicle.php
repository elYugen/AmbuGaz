<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $license_plate = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $year_of_service = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $technical_inspection_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $insurance_date = null;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $company = null;

    /**
     * @var Collection<int, Disinfections>
     */
    #[ORM\OneToMany(targetEntity: Disinfections::class, mappedBy: 'vehicle_id')]
    private Collection $disinfections;

    public function __construct()
    {
        $this->disinfections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLicensePlate(): ?string
    {
        return $this->license_plate;
    }

    public function setLicensePlate(string $license_plate): static
    {
        $this->license_plate = $license_plate;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getYearOfService(): ?int
    {
        return $this->year_of_service;
    }

    public function setYearOfService(int $year_of_service): static
    {
        $this->year_of_service = $year_of_service;

        return $this;
    }

    public function getTechnicalInspectionDate(): ?\DateTime
    {
        return $this->technical_inspection_date;
    }

    public function setTechnicalInspectionDate(\DateTime $technical_inspection_date): static
    {
        $this->technical_inspection_date = $technical_inspection_date;

        return $this;
    }

    public function getInsuranceDate(): ?\DateTime
    {
        return $this->insurance_date;
    }

    public function setInsuranceDate(\DateTime $insurance_date): static
    {
        $this->insurance_date = $insurance_date;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): static
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection<int, Disinfections>
     */
    public function getDisinfections(): Collection
    {
        return $this->disinfections;
    }

    public function addDisinfection(Disinfections $disinfection): static
    {
        if (!$this->disinfections->contains($disinfection)) {
            $this->disinfections->add($disinfection);
            $disinfection->setVehicle($this);
        }

        return $this;
    }

    public function removeDisinfection(Disinfections $disinfection): static
    {
        if ($this->disinfections->removeElement($disinfection)) {
            // set the owning side to null (unless already changed)
            if ($disinfection->getVehicle() === $this) {
                $disinfection->setVehicle(null);
            }
        }

        return $this;
    }
}
