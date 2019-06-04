<?php
namespace RFY\Shop\JsonApi\Api\Product;

/*
 * This file is part of the RFY.Shop package.
 */

use Neos\Flow\Annotations as Flow;
use Neomerx\JsonApi\Schema\BaseSchema;
use RFY\Shop\Domain\Model\Product;
use Neos\Flow\Persistence\PersistenceManagerInterface;

/**
 * Entity SchemaProvider
 * @Flow\Scope("singleton")
 */
class Schema extends BaseSchema
{
    /**
     * @var string
     */
    protected $resourceType = 'RFY\Shop\Domain\Model\Product';

    /**
     * @var string
     */
    protected $type = 'products';

    /**
     * @var PersistenceManagerInterface
     * @Flow\Inject
     */
    protected $persistenceManager;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param Product $resource
     * @return string
     */
    public function getId($resource): string
    {
        return $this->persistenceManager->getIdentifierByObject($resource);
    }

    /**
     * @param null $resource
     * @return string
     */
    public function getSelfSubUrl($resource = null): string
    {
        return \sprintf('/%s/%s', $this->type, $this->getId($resource));
    }

    /**
     * Get resource attributes.
     *
     * @param Product $resource
     *
     * @return array
     */
    public function getAttributes($resource): iterable
    {
        $attributes = [
            'name' => $resource->getName(),
            'description' => $resource->getDescription(),
            'created-at' => $resource->getCreatedAt()->format(\DateTime::ISO8601),
            'modified-at' => $resource->getModifiedAt()->format(\DateTime::ISO8601),
            'original-price' => $resource->getOriginalPrice(),
            'price' => $resource->getPrice(),
            'purchased' => $resource->getPurchased(),
            'favoured' => $resource->getFavoured(),
            'views' => $resource->getViews(),
            'in-stock' => $resource->getInStock(),
        ];

        return $attributes;
    }

    /**
     * @param Product $resource
     * @return array
     */
    public function getRelationships($resource): iterable
    {
        $relationships = [
        ];

        return $relationships;
    }

    /**
     * @return array
     */
    public function getIncludePaths()
    {
        return [];
    }
}
