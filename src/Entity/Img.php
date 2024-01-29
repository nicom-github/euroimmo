<?php

namespace App\Entity;

use App\Repository\ImgRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImgRepository::class)]
class Img
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 12, nullable: true)]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'img', targetEntity: User::class)]
    private Collection $user;

    #[ORM\ManyToMany(targetEntity: RealEstate::class, inversedBy: 'imgs')]
    private Collection $realEstate;

    #[ORM\OneToMany(mappedBy: 'img', targetEntity: Agency::class)]
    private Collection $agencies;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->realEstate = new ArrayCollection();
        $this->agencies = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setImg($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getImg() === $this) {
                $user->setImg(null);
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
        }

        return $this;
    }

    public function removeRealEstate(RealEstate $realEstate): static
    {
        $this->realEstate->removeElement($realEstate);

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
            $agency->setImg($this);
        }

        return $this;
    }

    public function removeAgency(Agency $agency): static
    {
        if ($this->agencies->removeElement($agency)) {
            // set the owning side to null (unless already changed)
            if ($agency->getImg() === $this) {
                $agency->setImg(null);
            }
        }

        return $this;
    }
}
