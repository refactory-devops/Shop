<?php
namespace RFY\Shop\Command;

/*
 * This file is part of the RFY.Shop package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;
use Neos\Flow\Persistence\PersistenceManagerInterface;
use RFY\Shop\Domain\Factory\OrderFactory;
use RFY\Shop\Domain\Factory\ProductFactory;
use RFY\Shop\Domain\Model\Product;
use SZ\SocialSmartz\Domain\Factory\MemberFactory;

/**
 * @Flow\Scope("singleton")
 */
class FakeCommandController extends CommandController
{

    /**
     * @var PersistenceManagerInterface
     * @Flow\Inject
     */
    protected $persistenceManager;

    /**
     * Create Fake products
     *
     * @param integer $count The amount of products to fake
     * @return void
     */
    public function productsCommand($count)
    {
        $this->outputLine('Generate "%s" fake products.', array($count));

        $factory = new ProductFactory();
        for ($i = 0; $i < $count; $i++) {
            $product = $factory->create();
            $this->persistenceManager->add($product);
        }

        $this->persistenceManager->persistAll();

        $this->outputLine('<b>Generated "%s" fake products!</b>', array($count));
    }

    /**
     * Create Fake orders
     *
     * @param integer $count The amount of orders to fake
     * @return void
     */
    public function ordersCommand($count)
    {
        $this->outputLine('Generate "%s" fake orders.', array($count));

        $factory = new OrderFactory();
        for ($i = 0; $i < $count; $i++) {
            $order = $factory->create();
            $this->persistenceManager->add($order);
        }

        $this->persistenceManager->persistAll();

        $this->outputLine('<b>Generated "%s" fake orders!</b>', array($count));
    }
}
