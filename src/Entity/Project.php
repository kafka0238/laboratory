<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $disease;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_order;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_inclusion_criterion;

    /**
     */
    private $inclusion_criterion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $additionally;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getIdOrder(): ?int
    {
        return $this->id_order;
    }

    public function setIdOrder(?int $id_order): self
    {
        $this->id_order = $id_order;

        return $this;
    }

    public function getIdInclusionCriterion(): ?int
    {
        return $this->id_inclusion_criterion;
    }

    public function setIdInclusionCriterion(?InclusionCriterion $id_inclusion_criterion): self
    {
        $this->id_inclusion_criterion = $id_inclusion_criterion->getId();

        return $this;
    }

    public function getInclusionCriterion(): ?array
    {
        return $this->inclusion_criterion;
    }

    public function setInclusionCriterion(?array $inclusion_criterion): self
    {
        $this->inclusion_criterion = $inclusion_criterion;

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
