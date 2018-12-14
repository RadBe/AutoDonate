<?php


namespace App\Services\Purchasing\Distributors;


use App\Entity\Purchase;
use App\Services\Purchasing\Distributors\RconDistribution\CommandBuilder;
use App\Services\Purchasing\Distributors\RconDistribution\Distribute;

class RconDistributor implements Distributor
{
    private $commandBuilder;

    private $distribute;

    public function __construct(CommandBuilder $builder, Distribute $distribute)
    {
        $this->commandBuilder = $builder;
        $this->distribute = $distribute;
    }

    public function distribute(Purchase $purchase): void
    {
        $this->distribute->handle(
            $purchase->getProduct()->getCategory()->getServer(),
            $this->commandBuilder->build($purchase)
        );
    }
}