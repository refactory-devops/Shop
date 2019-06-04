<?php
namespace RFY\Shop\Domain\Model;

/*
 * This file is part of the RFY.Shop package.
 */

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class OrderLine
{
    /**
     * @var Order
     * @ORM\ManyToOne(inversedBy="orderLines", cascade={"all"})
     */
    protected $parent;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $modifiedAt;

    /**
     * @var Product
     * @ORM\ManyToOne
     */
    protected $product;

    /**
     * @var int
     */
    protected $quantity = 0;

    /**
     * @var float
     */
    protected $amount = 0.00;

    /**
     * @return Order
     */
    public function getParent(): Order
    {
        return $this->parent;
    }

    /**
     * @param Order $parent
     */
    public function setParent(Order $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
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
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * @return void
     */
    public function setAmount(): void
    {
        $this->amount = $this->product->getPrice() * $this->getQuantity();
    }
}
