<?php

namespace RFY\Shop\Domain\Model;

/*
 * This file is part of the RFY.Shop package.
 */

use Doctrine\Common\Collections\ArrayCollection;
use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Neos\Media\Domain\Model\Asset;

/**
 * @Flow\Entity
 */
class Product
{

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $modifiedAt;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var Asset
     * @ORM\ManyToOne
     */
    protected $primaryImage;

    /**
     * @var string
     */
    protected $images;

    /**
     * @var float
     */
    protected $originalPrice = 0.00;

    /**
     * @var float
     */
    protected $price = 0.00;

    /**
     * @var int
     */
    protected $inStock = 0;

    /**
     * @var int
     */
    protected $views = 0;

    /**
     * @var int
     */
    protected $purchased = 0;

    /**
     * @var int
     */
    protected $favoured = 0;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Asset
     */
    public function getPrimaryImage(): ?Asset
    {
        return $this->primaryImage;
    }

    /**
     * @param Asset $primaryImage
     */
    public function setPrimaryImage(Asset $primaryImage): void
    {
        $this->primaryImage = $primaryImage;
    }

    /**
     * @return string
     */
    public function getImages(): string
    {
        return $this->images;
    }

    /**
     * @param string $images
     */
    public function setImages(string $images): void
    {
        $this->images = $images;
    }

    /**
     * @return float
     */
    public function getOriginalPrice(): float
    {
        return $this->originalPrice;
    }

    /**
     * @param float $originalPrice
     */
    public function setOriginalPrice(float $originalPrice): void
    {
        $this->originalPrice = $originalPrice;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getInStock(): int
    {
        return $this->inStock;
    }

    /**
     * @param int $inStock
     */
    public function setInStock(int $inStock): void
    {
        $this->inStock = $inStock;
    }

    /**
     * @return int
     */
    public function getViews(): int
    {
        return $this->views;
    }

    /**
     * @param int $views
     */
    public function setViews(int $views): void
    {
        $this->views = $views;
    }

    /**
     * @return int
     */
    public function getPurchased(): int
    {
        return $this->purchased;
    }

    /**
     * @param int $purchased
     */
    public function setPurchased(int $purchased): void
    {
        $this->purchased = $purchased;
    }

    /**
     * @return int
     */
    public function getFavoured(): int
    {
        return $this->favoured;
    }

    /**
     * @param int $favoured
     */
    public function setFavoured(int $favoured): void
    {
        $this->favoured = $favoured;
    }
}
