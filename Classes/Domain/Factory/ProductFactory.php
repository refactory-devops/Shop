<?php

namespace RFY\Shop\Domain\Factory;

use Neos\Flow\Annotations as Flow;
use Faker\Factory;
use Neos\Flow\ResourceManagement\ResourceManager;
use RFY\Shop\Domain\Model\Product;
use SZ\SocialSmartz\Domain\Model\Group;
use SZ\SocialSmartz\Domain\Model\Member;
use SZ\SocialSmartz\Domain\Model\Organisation;
use SZ\SocialSmartz\Domain\Model\Campaign;
use SZ\SocialSmartz\Domain\Repository\OrganisationRepository;

/**
 * Class ProductFactory
 * @package RFY\Shop\Domain\Factory
 */
class ProductFactory
{

    /**
     * @var ResourceManager
     * @Flow\Inject()
     */
    protected $resourceManager;

    /**
     * @return Product
     */
    public function create()
    {
        $faker = Factory::create();
        $product = new Product();

        $product->setName($faker->name);
        $product->setDescription($faker->text());
        $product->setOriginalPrice($faker->randomFloat(null, 100, 999));
        $product->setPrice($faker->randomFloat(null, 100, 100000));

        $product->setInStock($faker->randomDigit);
        $product->setViews($faker->randomDigit);
        $product->setFavoured($faker->randomDigit);
        $product->setPurchased($faker->randomDigit);

        return $product;
    }
}