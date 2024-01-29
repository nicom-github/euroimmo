<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\Column(length: 30)]
    private ?string $forename = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $mobilephonenumber = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $phonenumber = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dtcreate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dtconnect = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Bank $bank = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Address $address = null;

    #[ORM\ManyToOne(inversedBy: 'user')]
    private ?Img $img = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: RealEstate::class)]
    private Collection $realEstate;

    public function __construct()
    {
        $this->realEstate = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
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

    public function getForename(): ?string
    {
        return $this->forename;
    }

    public function setForename(string $forename): static
    {
        $this->forename = $forename;

        return $this;
    }

    public function getMobilephonenumber(): ?string
    {
        return $this->mobilephonenumber;
    }

    public function setMobilephonenumber(?string $mobilephonenumber): static
    {
        $this->mobilephonenumber = $mobilephonenumber;

        return $this;
    }

    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    public function setPhonenumber(?string $phonenumber): static
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

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

    public function getDtconnect(): ?\DateTimeInterface
    {
        return $this->dtconnect;
    }

    public function setDtconnect(\DateTimeInterface $dtconnect): static
    {
        $this->dtconnect = $dtconnect;

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
            $realEstate->setUser($this);
        }

        return $this;
    }

    public function removeRealEstate(RealEstate $realEstate): static
    {
        if ($this->realEstate->removeElement($realEstate)) {
            // set the owning side to null (unless already changed)
            if ($realEstate->getUser() === $this) {
                $realEstate->setUser(null);
            }
        }

        return $this;
    }
}
