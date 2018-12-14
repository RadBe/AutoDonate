<?php


namespace App\Services\Purchasing\Distributors;


class Pool
{
    private $distributors;

    public function __construct(array $distributors)
    {
        $this->distributors = $distributors;
    }

    public function find(string $distributorClass): ?Distributor
    {
        foreach ($this->distributors as $distributor)
        {
            if(get_class($distributor) === $distributorClass) {
                return $distributor;
            }
        }

        return null;
    }
}