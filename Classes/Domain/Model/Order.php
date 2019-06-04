<?php
namespace RFY\Shop\Domain\Model;

/*
 * This file is part of the RFY.Shop package.
 */

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Flow\Entity
 */
class Order
{
    /**
     * @var string
     */
    protected $orderNumber;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $modifiedAt;

    /**
     * @var ArrayCollection<OrderLine>
     * @ORM\OneToMany(mappedBy="parent", cascade={"all"})
     */
    protected $orderLines;

    /**
     * @var float
     */
    protected $totalPrice = 0.00;

    /**
     * Order constructor.
     */
    public function __construct()
    {
        $this->orderLines = new ArrayCollection();
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     * @return void
     * @throws \Exception
     */
    public function setCreatedAt(): void
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return \DateTime
     */
    public function getModifiedAt(): \DateTime
    {
        return $this->modifiedAt;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * @return void
     * @throws \Exception
     */
    public function setModifiedAt(): void
    {
        $this->modifiedAt = new \DateTime('now');
    }

    /**
     * @return string
     */
    public function getOrderNumber(): string
    {
        return $this->orderNumber;
    }

    /**
     * @param string $orderNumber
     */
    public function setOrderNumber(string $orderNumber): void
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * @return ArrayCollection
     */
    public function getOrderLines()
    {
        return $this->orderLines;
    }

    /**
     * @param ArrayCollection $orderLines
     */
    public function setOrderLines(ArrayCollection $orderLines): void
    {
        $this->orderLines = $orderLines;
    }

    /**
     * @param OrderLine $orderLine
     */
    public function addOrderLine(OrderLine $orderLine)
    {
        if (!$this->orderLines->contains($orderLine)) {
            $this->orderLines->add($orderLine);
            $orderLine->setParent($this);
        }
    }

    /**
     * @param OrderLine $orderLine
     */
    public function removeOrderLine(OrderLine $orderLine)
    {
        if ($this->orderLines->contains($orderLine)) {
            $this->orderLines->removeElement($orderLine);
        }
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * @return void
     */
    public function setTotalPrice(): void
    {
        $totalPrice = 0.00;

        /** @var OrderLine $orderLine */
        foreach($this->orderLines as $orderLine) {
            $totalPrice += $orderLine->getAmount();
        }

        $this->totalPrice = $totalPrice;
    }
}
