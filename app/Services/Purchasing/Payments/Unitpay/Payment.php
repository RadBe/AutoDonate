<?php


namespace App\Services\Purchasing\Payments\Unitpay;


class Payment
{
    private $purchaseId;

    private $cost;

    private $description;

    public function __construct(int $purchaseId, int $cost, string $description)
    {
        $this->purchaseId = $purchaseId;
        $this->cost = $cost;
        $this->description = $description;
    }

    public function getPurchaseId(): int
    {
        return $this->purchaseId;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}