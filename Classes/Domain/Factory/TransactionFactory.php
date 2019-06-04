<?php

namespace RFY\Shop\Domain\Factory;

use Neos\Flow\Annotations as Flow;
use Faker\Factory;
use RFY\Shop\Domain\Model\Transaction;
use SZ\SocialSmartz\Domain\Model\Group;
use SZ\SocialSmartz\Domain\Model\Member;
use SZ\SocialSmartz\Domain\Model\Organisation;
use SZ\SocialSmartz\Domain\Model\Campaign;
use SZ\SocialSmartz\Domain\Repository\OrganisationRepository;

/**
 * Class TransactionFactory
 * @package RFY\Shop\Domain\Factory
 */
class TransactionFactory
{

    public function create()
    {
        $faker = Factory::create();
        $transaction = new Transaction();

        return $transaction;
    }
}