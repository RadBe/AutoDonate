<?php


namespace App\Services\Purchasing\Distributors\RconDistribution;


use App\Entity\Purchase;
use App\Exceptions\RuntimeException;

class CommandBuilder
{
    public function build(Purchase $purchase): string
    {
        $extra = $purchase->getProduct()->getJsonData();

        $command = $extra['command'];

        if(empty($command)) {
            throw new RuntimeException("Команда товара #{$purchase->getProduct()->getId()} не задана!");
        }

        return str_replace(
            'player',
            $purchase->getName(),
            str_replace(
                'server',
                $purchase->getProduct()->getCategory()->getServer()->getName(),
                $command
            )
        );
    }
}