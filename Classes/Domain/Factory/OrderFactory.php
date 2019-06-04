<?php

namespace RFY\Shop\Domain\Factory;

use Neos\Flow\Annotations as Flow;
use Faker\Factory;
use RFY\Shop\Domain\Model\Order;
use RFY\Shop\Domain\Model\OrderLine;
use RFY\Shop\Domain\Repository\ProductRepository;

/**
 * Class OrderFactory
 * @package RFY\Shop\Domain\Factory
 */
class OrderFactory
{
    /**
     * @Flow\Inject()
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var array
     */
    protected $products;

    /**
     * @return Order
     */
    public function create()
    {
        $faker = Factory::create();
        $this->getProduct();

        $order = new Order();
        $order->setOrderNumber($faker->randomLetter);

        for ($i = 0; $i < 3; $i++) {
            $orderLine = new OrderLine();
            $order->addOrderLine($orderLine);
            $orderLine->setProduct($faker->randomElement($this->products));
            $orderLine->setQuantity($faker->randomDigit);
        }
        return $order;
    }

    /**
     *
     */
    protected function getProduct()
    {
        $this->products = $this->productRepository->findAll()->toArray();
    }
}
