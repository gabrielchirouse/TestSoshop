<?php

namespace App\Entity;

use App\Repository\AccountBankRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass=AccountBankRepository::class)
 * @Serializer\ExclusionPolicy("ALL")
 */
class AccountBank
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Serializer\Expose
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=34)
     * @Serializer\Expose
     */
    private $iban;

    /**
     * @ORM\Column(type="string", length=11)
     * @Serializer\Expose
     */
    private $bic;

    /**
     * @ORM\Column(type="float")
     * @Serializer\Expose
     */
    private $balance;

    /**
     * @ORM\OneToOne(targetEntity=CardBank::class, inversedBy="accountBank", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Expose
     */
    private $cardBank;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="accountBanks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Serializer\Expose
     */
    private $deletionDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    public function getBic(): ?string
    {
        return $this->bic;
    }

    public function setBic(string $bic): self
    {
        $this->bic = $bic;

        return $this;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    public function getCardBank(): ?CardBank
    {
        return $this->cardBank;
    }

    public function setCardBank(CardBank $cardBank): self
    {
        $this->cardBank = $cardBank;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDeletionDate(): ?\DateTimeInterface
    {
        return $this->deletionDate;
    }

    public function setDeletionDate(?\DateTimeInterface $deletionDate): self
    {
        $this->deletionDate = $deletionDate;

        return $this;
    }
}
