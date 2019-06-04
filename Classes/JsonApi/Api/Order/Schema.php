<?php
namespace RFY\Shop\JsonApi\Api\Order;

/*
 * This file is part of the RFY.Shop package.
 */

use Neos\Flow\Annotations as Flow;
use Neomerx\JsonApi\Schema\BaseSchema;
use RFY\Shop\Domain\Model\Order;
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
    protected $resourceType = 'RFY\Shop\Domain\Model\Order';

    /**
     * @var string
     */
    protected $type = 'orders';

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
     * @param Order $resource
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
     * @param Order $resource
     *
     * @return array
     */
    public function getAttributes($resource): iterable
    {
        $attributes = [
            'order-number' => $resource->getOrderNumber(),
            'created-at' => $resource->getCreatedAt()->format(\DateTime::ISO8601),
            'modified-at' => $resource->getModifiedAt()->format(\DateTime::ISO8601),
            'total-price' => $resource->getTotalPrice(),
        ];

        return $attributes;
    }

    /**
     * @param Order $resource
     * @return array
     */
    public function getRelationships($resource): iterable
    {
        $relationships = [
            'order-lines' => [
                self::RELATIONSHIP_DATA => $resource->getOrderLines(),
                self::RELATIONSHIP_LINKS_SELF => true,
                self::RELATIONSHIP_LINKS_RELATED => true,
            ]
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
