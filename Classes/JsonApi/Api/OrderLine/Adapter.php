<?php
namespace RFY\Shop\JsonApi\Api\OrderLine;

/*
 * This file is part of the RFY.Shop package.
 */

use Neos\Flow\Annotations as Flow;
use Flowpack\JsonApi\Adapter\AbstractAdapter;

/**
 * @Flow\Scope("singleton")
 */
class Adapter extends AbstractAdapter
{
    /**
     * Map attributes to different named properties
     * @var array
     */
    protected $attributesMapping = [];

    /**
     * @param \Neos\Flow\Persistence\QueryInterface $query
     * @param array|null $filters
     */
    public function filter($query, $filters)
    {
        // Add filters here
    }
}
