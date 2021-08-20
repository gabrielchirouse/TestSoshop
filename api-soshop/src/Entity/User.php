<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=10)
     * @ORM\JoinColumn(nullable=false)
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity=AccountBank::class, mappedBy="user")
     */
    private $accountBanks;

    public function __construct()
    {
        $this->accountBanks = new ArrayCollection();
    }

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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection|AccountBank[]
     */
    public function getAccountBanks(): Collection
    {
        return $this->accountBanks;
    }

    public function addAccountBank(AccountBank $accountBank): self
    {
        if (!$this->accountBanks->contains($accountBank)) {
            $this->accountBanks[] = $accountBank;
            $accountBank->setUser($this);
        }

        return $this;
    }

    public function removeAccountBank(AccountBank $accountBank): self
    {
        if ($this->accountBanks->removeElement($accountBank)) {
            // set the owning side to null (unless already changed)
            if ($accountBank->getUser() === $this) {
                $accountBank->setUser(null);
            }
        }

        return $this;
    }
}
