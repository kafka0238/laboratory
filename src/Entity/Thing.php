<?php

namespace App\Entity;

use App\Repository\ThingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ThingRepository::class)
 */
class Thing
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_project;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_laboratory;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $collection_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $processing_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $clinical_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $additionally;

    private $projects;
    private $laboratories;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProject(): ?int
    {
        return $this->id_project;
    }

    public function setIdProject(?Project $project): self
    {
        $this->id_project = $project->getId();

        return $this;
    }

    public function getIdLaboratory(): ?int
    {
        return $this->id_laboratory;
    }

    public function setIdLaboratory(?Laboratory $laboratory): self
    {
        $this->id_laboratory = $laboratory->getId();

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCollectionDate(): ?\DateTimeInterface
    {
        return $this->collection_date;
    }

    public function setCollectionDate(?\DateTimeInterface $collection_date): self
    {
        $this->collection_date = $collection_date;

        return $this;
    }

    public function getProcessingDate(): ?\DateTimeInterface
    {
        return $this->processing_date;
    }

    public function setProcessingDate(?\DateTimeInterface $processing_date): self
    {
        $this->processing_date = $processing_date;

        return $this;
    }

    public function getClinicalDate(): ?string
    {
        return $this->clinical_date;
    }

    public function setClinicalDate(?string $clinical_date): self
    {
        $this->clinical_date = $clinical_date;

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

    public function getProjects(): ?array
    {
        return $this->projects;
    }

    public function setProjects(?array $projects): self
    {
        $this->projects = $projects;

        return $this;
    }

    public function getLaboratories(): ?array
    {
        return $this->laboratories;
    }

    public function setLaboratories(?array $laboratories): self
    {
        $this->laboratories = $laboratories;

        return $this;
    }
}
