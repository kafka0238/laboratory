<?php

namespace App\Entity;

use App\Repository\LaboratoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LaboratoryRepository::class)
 */
class Laboratory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $pm;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $salary_pm;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $pi;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $salary_pi;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $cost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPm(): ?string
    {
        return $this->pm;
    }

    public function setPm(?string $pm): self
    {
        $this->pm = $pm;

        return $this;
    }

    public function getSalaryPm(): ?string
    {
        return $this->salary_pm;
    }

    public function setSalaryPm(?string $salary_pm): self
    {
        $this->salary_pm = $salary_pm;

        return $this;
    }

    public function getPi(): ?string
    {
        return $this->pi;
    }

    public function setPi(?string $pi): self
    {
        $this->pi = $pi;

        return $this;
    }

    public function getSalaryPi(): ?string
    {
        return $this->salary_pi;
    }

    public function setSalaryPi(?string $salary_pi): self
    {
        $this->salary_pi = $salary_pi;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(?string $cost): self
    {
        $this->cost = $cost;

        return $this;
    }
}
