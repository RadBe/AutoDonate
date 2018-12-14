<?php


namespace App\DataObjects\Payment;


use App\Entity\PromoCode;
use App\Entity\Purchase;

class OrderPipelineObject
{
    /**
     * @var Purchase
     */
    private $purchase;

    /**
     * @var bool
     */
    private $surcharge = false;

    /**
     * OrderPipelineObject constructor.
     *
     * @param Purchase $purchase
     */
    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    /**
     * @return Purchase
     */
    public function getPurchase(): Purchase
    {
        return $this->purchase;
    }

    /**
     * @param bool $surcharge
     */
    public function setSurcharge(bool $surcharge): void
    {
        $this->surcharge = $surcharge;
    }

    /**
     * @return bool
     */
    public function isSurcharge(): bool
    {
        return $this->surcharge;
    }
}