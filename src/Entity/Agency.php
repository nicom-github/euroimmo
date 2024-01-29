<?php

namespace App\Entity;

use App\Repository\AgencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgencyRepository::class)]
class Agency
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'agencies')]
    private ?Bank $bank = null;

    #[ORM\ManyToOne(inversedBy: 'Agencies')]
    private ?Address $address = null;

    #[ORM\ManyToOne(inversedBy: 'agencies')]
    private ?Img $img = null;

    #[ORM\ManyToMany(targetEntity: RealEstate::class, inversedBy: 'agencies')]
    private Collection $realEstate;

    public function __construct()
    {
        $this->realEstate = new ArrayCollection();
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

    public function getBank(): ?Bank
    {
        return $this->bank;
    }

    public function setBank(?Bank $bank): static
    {
        $this->bank = $bank;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getImg(): ?Img
    {
        return $this->img;
    }

    public function setImg(?Img $img): static
    {
        $this->img = $img;

        return $this;
    }

    /**
     * @return Collection<int, RealEstate>
     */
    public function getRealEstate(): Collection
    {
        return $this->realEstate;
    }

    public function addRealEstate(RealEstate $realEstate): static
    {
        if (!$this->realEstate->contains($realEstate)) {
            $this->realEstate->add($realEstate);
        }

        return $this;
    }

    public function removeRealEstate(RealEstate $realEstate): static
    {
        $this->realEstate->removeElement($realEstate);

        return $this;
    }
}
