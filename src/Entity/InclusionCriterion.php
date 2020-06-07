<?php

namespace App\Entity;

use App\Repository\InclusionCriterionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InclusionCriterionRepository::class)
 */
class InclusionCriterion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nationality;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $smoking;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $alcohol;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $disease;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subtype;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $stage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $treatment;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $chronic_disease;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $additionally;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getSmoking(): ?string
    {
        return $this->smoking;
    }

    public function setSmoking(?string $smoking): self
    {
        $this->smoking = $smoking;

        return $this;
    }

    public function getAlcohol(): ?string
    {
        return $this->alcohol;
    }

    public function setAlcohol(?string $alcohol): self
    {
        $this->alcohol = $alcohol;

        return $this;
    }

    public function getDisease(): ?string
    {
        return $this->disease;
    }

    public function setDisease(?string $disease): self
    {
        $this->disease = $disease;

        return $this;
    }

    public function getSubtype(): ?string
    {
        return $this->subtype;
    }

    public function setSubtype(?string $subtype): self
    {
        $this->subtype = $subtype;

        return $this;
    }

    public function getStage(): ?string
    {
        return $this->stage;
    }

    public function setStage(?string $stage): self
    {
        $this->stage = $stage;

        return $this;
    }

    public function getTreatment(): ?string
    {
        return $this->treatment;
    }

    public function setTreatment(?string $treatment): self
    {
        $this->treatment = $treatment;

        return $this;
    }

    public function getChronicDisease(): ?string
    {
        return $this->chronic_disease;
    }

    public function setChronicDisease(?string $chronic_disease): self
    {
        $this->chronic_disease = $chronic_disease;

        return $this;
    }

    public function getAdditionally(): ?string
    {
        return $this->additionally;
    }

    public function setAdditionally(?string $additionally): self
    {
        $this->additionally = $additionally;

        return $this;
    }
}
