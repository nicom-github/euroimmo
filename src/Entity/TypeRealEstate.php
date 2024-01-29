<?php

namespace App\Entity;

use App\Repository\TypeRealEstateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRealEstateRepository::class)]
class TypeRealEstate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: RealEstate::class)]
    private Collection $realEstates;

    public function __construct()
    {
        $this->realEstates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, RealEstate>
     */
    public function getRealEstates(): Collection
    {
        return $this->realEstates;
    }

    public function addRealEstate(RealEstate $realEstate): static
    {
        if (!$this->realEstates->contains($realEstate)) {
            $this->realEstates->add($realEstate);
            $realEstate->setType($this);
        }

        return $this;
    }

    public function removeRealEstate(RealEstate $realEstate): static
    {
        if ($this->realEstates->removeElement($realEstate)) {
            // set the owning side to null (unless already changed)
            if ($realEstate->getType() === $this) {
                $realEstate->setType(null);
            }
        }

        return $this;
    }
}
