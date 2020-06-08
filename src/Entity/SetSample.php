<?php

namespace App\Entity;

use App\Repository\SetSampleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SetSampleRepository::class)
 */
class SetSample
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
    private $lable;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_thing;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_material;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_container;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_storage_method;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_laboratory;

    private $materials;

    private $containers;

    private $storage_methods;

    private $laboratories;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLable(): ?string
    {
        return $this->lable;
    }

    public function setLable(?string $lable): self
    {
        $this->lable = $lable;

        return $this;
    }

    public function getIdThing(): ?int
    {
        return $this->id_thing;
    }

    public function setIdThing(?int $id_thing): self
    {
        $this->id_thing = $id_thing;

        return $this;
    }

    public function getIdMaterial(): ?int
    {
        return $this->id_material;
    }

    public function setIdMaterial(?Material $material): self
    {
        $this->id_material = $material->getId();

        return $this;
    }

    public function getIdContainer(): ?int
    {
        return $this->id_container;
    }

    public function setIdContainer(?Container $container): self
    {
        $this->id_container = $container->getId();

        return $this;
    }

    public function getIdStorageMethod(): ?int
    {
        return $this->id_storage_method;
    }

    public function setIdStorageMethod(?StorageMethod $storage_method): self
    {
        $this->id_storage_method = $storage_method->getId();

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

    public function getMaterials(): ?array
    {
        return $this->materials;
    }

    public function setMaterials(?array $materials): self
    {
        $this->materials = $materials;

        return $this;
    }

    public function getContainers(): ?array
    {
        return $this->containers;
    }

    public function setContainers(?array $containers): self
    {
        $this->containers = $containers;

        return $this;
    }

    public function getStorageMethods(): ?array
    {
        return $this->storage_methods;
    }

    public function setStorageMethods(?array $storage_methods): self
    {
        $this->storage_methods = $storage_methods;

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
