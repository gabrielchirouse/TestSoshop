<?php

namespace App\Entity;

use App\Repository\CardBankRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Response;

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
     * @ORM\Column(type="string", length=255, columnDefinition="ENUM('active', 'fermée', 'volée')")
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity=AccountBank::class, mappedBy="cardBank", cascade={"persist", "remove"})
     */
    private $accountBank;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $deletionDate;

    /**
     * @ORM\Column(type="date")
     */
    private $expiryDate;

    public function __construct()
    {
        $this->status = 'active';
    }

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

    /**
     * @throws \Exception
     */
    public function setStatus(string $status): self
    {
        if (!in_array($status,['active','fermée','volée'])){
            throw new \Exception('the status is not included in active, fermée and volée.',Response::HTTP_NOT_ACCEPTABLE);
        }
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

    public function getDeletionDate(): ?\DateTimeInterface
    {
        return $this->deletionDate;
    }

    public function setDeletionDate(?\DateTimeInterface $deletionDate): self
    {
        $this->deletionDate = $deletionDate;

        return $this;
    }

    public function getExpiryDate(): ?\DateTimeInterface
    {
        return $this->expiryDate;
    }

    public function setExpiryDate(\DateTimeInterface $expiryDate): self
    {
        $this->expiryDate = $expiryDate;

        return $this;
    }
}
