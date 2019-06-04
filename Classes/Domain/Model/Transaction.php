<?php
namespace RFY\Shop\Domain\Model;

/*
 * This file is part of the RFY.Shop package.
 */

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Neos\Party\Domain\Model\Person;

/**
 * @Flow\Entity
 */
class Transaction
{
    const TYPE_DEBIT = 'Debit';
    const TYPE_CREDIT = 'Credit';

    /**
     * @var Order
     * @ORM\ManyToOne
     */
    protected $order;

    /**
     * @var Person
     * @ORM\ManyToOne
     */
    protected $createdBy;

    /**
     * @var \DateTime
     */
    protected $transactionDate;

    /**
     * @var float
     */
    protected $amount = 0.00;

    /**
     * @var string
     */
    protected $type;

    /**
     * @return Person
     */
    public function getCreatedBy(): Person
    {
        return $this->createdBy;
    }

    /**
     * @param Person $createdBy
     */
    public function setCreatedBy(Person $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return \DateTime
     */
    public function getTransactionDate(): \DateTime
    {
        return $this->transactionDate;
    }

    /**
     * @ORM\PrePersist
     * @return void
     * @throws \Exception
     */
    public function setTransactionDate(): void
    {
        $this->transactionDate = new \DateTime('now');
    }

}
