<?php

namespace App\Entity;

use App\Repository\CardBankRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CardBankRepository::class)
 */
class CardBank
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="bigint")
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity=AccountBank::class, mappedBy="cardBank", cascade={"persist", "remove"})
     */
    private $accountBank;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAccountBank(): ?AccountBank
    {
        return $this->accountBank;
    }

    public function setAccountBank(AccountBank $accountBank): self
    {
        // set the owning side of the relation if necessary
        if ($accountBank->getCardBank() !== $this) {
            $accountBank->setCardBank($this);
        }

        $this->accountBank = $accountBank;

        return $this;
    }
}
