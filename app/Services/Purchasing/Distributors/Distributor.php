<?php


namespace App\Services\Purchasing\Distributors;


use App\Entity\Purchase;

interface Distributor
{
    public function distribute(Purchase $purchase): void;
}