<?php

namespace App\Entity;

use App\Repository\RealEstateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RealEstateRepository::class)]
class RealEstate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $livingarea = null;

    #[ORM\Column(nullable: true)]
    private ?int $landarea = null;

    #[ORM\Column(nullable: true)]
    private ?int $piecenumber = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dtcreate = null;

    #[ORM\ManyToOne(inversedBy: 'realEstate')]
    private ?Address $address = null;

    #[ORM\ManyToMany(targetEntity: Img::class, mappedBy: 'realEstate')]
    private Collection $imgs;

    #[ORM\ManyToOne(inversedBy: 'realEstate')]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Agency::class, mappedBy: 'realEstate')]
    private Collection $agencies;

    #[ORM\ManyToOne(inversedBy: 'realEstates')]
    private ?StatusRealEstate $status = null;

    #[ORM\ManyToOne(inversedBy: 'realEstates')]
    private ?TypeRealEstate $type = null;

    public function __construct()
    {
        $this->imgs = new ArrayCollection();
        $this->agencies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLivingarea(): ?int
    {
        return $this->livingarea;
    }

    public function setLivingarea(?int $livingarea): static
    {
        $this->livingarea = $livingarea;

        return $this;
    }

    public function getLandarea(): ?int
    {
        return $this->landarea;
    }

    public function setLandarea(?int $landarea): static
    {
        $this->landarea = $landarea;

        return $this;
    }

    public function getPiecenumber(): ?int
    {
        return $this->piecenumber;
    }

    public function setPiecenumber(?int $piecenumber): static
    {
        $this->piecenumber = $piecenumber;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDtcreate(): ?\DateTimeInterface
    {
        return $this->dtcreate;
    }

    public function setDtcreate(\DateTimeInterface $dtcreate): static
    {
        $this->dtcreate = $dtcreate;

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

    /**
     * @return Collection<int, Img>
     */
    public function getImgs(): Collection
    {
        return $this->imgs;
    }

    public function addImg(Img $img): static
    {
        if (!$this->imgs->contains($img)) {
            $this->imgs->add($img);
            $img->addRealEstate($this);
        }

        return $this;
    }

    public function removeImg(Img $img): static
    {
        if ($this->imgs->removeElement($img)) {
            $img->removeRealEstate($this);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Agency>
     */
    public function getAgencies(): Collection
    {
        return $this->agencies;
    }

    public function addAgency(Agency $agency): static
    {
        if (!$this->agencies->contains($agency)) {
            $this->agencies->add($agency);
            $agency->addRealEstate($this);
        }

        return $this;
    }

    public function removeAgency(Agency $agency): static
    {
        if ($this->agencies->removeElement($agency)) {
            $agency->removeRealEstate($this);
        }

        return $this;
    }

    public function getStatus(): ?StatusRealEstate
    {
        return $this->status;
    }

    public function setStatus(?StatusRealEstate $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getType(): ?TypeRealEstate
    {
        return $this->type;
    }

    public function setType(?TypeRealEstate $type): static
    {
        $this->type = $type;

        return $this;
    }
}
