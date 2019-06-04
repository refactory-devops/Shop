<?php
namespace RFY\Shop\JsonApi\Api\OrderLine;

/*
 * This file is part of the RFY.Shop package.
 */

use Neos\Flow\Annotations as Flow;
use Neomerx\JsonApi\Schema\BaseSchema;
use RFY\Shop\Domain\Model\OrderLine;
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
    protected $resourceType = 'RFY\Shop\Domain\Model\OrderLine';

    /**
     * @var string
     */
    protected $type = 'order-lines';

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
     * @param OrderLine $resource
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
     * @param OrderLine $resource
     *
     * @return array
     */
    public function getAttributes($resource): iterable
    {
        $attributes = [
            'quantity' => $resource->getQuantity(),
            'created-at' => $resource->getCreatedAt()->format(\DateTime::ISO8601),
            'modified-at' => $resource->getModifiedAt()->format(\DateTime::ISO8601),
            'amount' => $resource->getAmount(),
        ];

        return $attributes;
    }

    /**
     * @param OrderLine $resource
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
