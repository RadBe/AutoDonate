<?php


namespace App\DataObjects\Payment;


use App\Entity\Purchase;
use App\Services\Purchasing\Payers\Payer;

class PaymentPipelineObject
{
    /**
     * @var Payer
     */
    private $payer;

    /**
     * @var Purchase
     */
    private $purchase;

    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $ip;

    /**
     * PaymentPipelineObject constructor.
     *
     * @param Payer $payer
     * @param Purchase $purchase
     * @param array $data
     * @param string $ip
     */
    public function __construct(Payer $payer, Purchase $purchase, array $data, string $ip)
    {
        $this->payer = $payer;
        $this->purchase = $purchase;
        $this->data = $data;
        $this->ip = $ip;
    }

    /**
     * @return Payer
     */
    public function getPayer(): Payer
    {
        return $this->payer;
    }

    /**
     * @return Purchase
     */
    public function getPurchase(): Purchase
    {
        return $this->purchase;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }
}