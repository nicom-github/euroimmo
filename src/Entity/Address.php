<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $town = null;

    #[ORM\Column(length: 10)]
    private ?string $zipcode = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $streetname = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $streetnumber = null;

    #[ORM\Column(nullable: true)]
    private ?float $latitude = null;

    #[ORM\Column(nullable: true)]
    private ?float $longitude = null;

    #[ORM\Column(nullable: true)]
    private ?int $floor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $additionaladdress = null;

    #[ORM\OneToMany(mappedBy: 'address', targetEntity: User::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'address', targetEntity: Agency::class)]
    private Collection $Agencies;

    #[ORM\OneToMany(mappedBy: 'address', targetEntity: RealEstate::class)]
    private Collection $realEstate;

    #[ORM\OneToMany(mappedBy: 'address', targetEntity: Bank::class)]
    private Collection $bank;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->Agencies = new ArrayCollection();
        $this->realEstate = new ArrayCollection();
        $this->bank = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(string $town): static
    {
        $this->town = $town;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): static
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getStreetname(): ?string
    {
        return $this->streetname;
    }

    public function setStreetname(?string $streetname): static
    {
        $this->streetname = $streetname;

        return $this;
    }

    public function getStreetnumber(): ?string
    {
        return $this->streetnumber;
    }

    public function setStreetnumber(?string $streetnumber): static
    {
        $this->streetnumber = $streetnumber;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(?int $floor): static
    {
        $this->floor = $floor;

        return $this;
    }

    public function getAdditionaladdress(): ?string
    {
        return $this->additionaladdress;
    }

    public function setAdditionaladdress(?string $additionaladdress): static
    {
        $this->additionaladdress = $additionaladdress;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setAddress($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getAddress() === $this) {
                $user->setAddress(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Agency>
     */
    public function getAgencies(): Collection
    {
        return $this->Agencies;
    }

    public function addAgency(Agency $agency): static
    {
        if (!$this->Agencies->contains($agency)) {
            $this->Agencies->add($agency);
            $agency->setAddress($this);
        }

        return $this;
    }

    public function removeAgency(Agency $agency): static
    {
        if ($this->Agencies->removeElement($agency)) {
            // set the owning side to null (unless already changed)
            if ($agency->getAddress() === $this) {
                $agency->setAddress(null);
            }
        }

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
            $realEstate->setAddress($this);
        }

        return $this;
    }

    public function removeRealEstate(RealEstate $realEstate): static
    {
        if ($this->realEstate->removeElement($realEstate)) {
            // set the owning side to null (unless already changed)
            if ($realEstate->getAddress() === $this) {
                $realEstate->setAddress(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Bank>
     */
    public function getBank(): Collection
    {
        return $this->bank;
    }

    public function addBank(Bank $bank): static
    {
        if (!$this->bank->contains($bank)) {
            $this->bank->add($bank);
            $bank->setAddress($this);
        }

        return $this;
    }

    public function removeBank(Bank $bank): static
    {
        if ($this->bank->removeElement($bank)) {
            // set the owning side to null (unless already changed)
            if ($bank->getAddress() === $this) {
                $bank->setAddress(null);
            }
        }

        return $this;
    }
}
