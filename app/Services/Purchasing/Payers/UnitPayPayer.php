<?php


namespace App\Services\Purchasing\Payers;


use App\Entity\Purchase;
use App\Exceptions\RuntimeException;
use App\Services\Purchasing\Payments\Unitpay\Checkout;
use App\Services\Purchasing\Payments\Unitpay\Payment;

class UnitPayPayer implements Payer
{
    private $checkout;

    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
    }

    public function name(): string
    {
        return 'unitpay';
    }

    public function purchaseId(array $data): int
    {
        return (int) $data['params']['account'];
    }

    public function paymentURL(Purchase $purchase, bool $surcharge): string
    {
        $type = $surcharge ? 'Доплата' : 'Покупка';

        $desc = "$type [{$purchase->getProduct()->getName()}] - {$purchase->getPrice()} руб./навсегда";
        $desc .= " на сервере [{$purchase->getProduct()->getCategory()->getServer()->getName()}]";
        $desc .= " ник [{$purchase->getName()}]";

        $payment = new Payment($purchase->getId(), $purchase->getPrice(), $desc);

        return $this->checkout->paymentUrl($payment);
    }

    public function validate(Purchase $purchase, array $data): bool
    {
        if((int)$data['params']['sum'] < $purchase->getPrice()) {
            throw new RuntimeException("Сумма меньше чем '{$purchase->getPrice()}'!");
        }

        if($this->checkout->validate($data)) {
            if($data['method'] !== 'pay') {
                print $this->successMessage($purchase);
                die;
            }
            return true;
        }

        return false;
    }

    public function successMessage(Purchase $purchase): string
    {
        return json_encode([
            "result" => [
                "message" => 'ОК'
            ]
        ], JSON_UNESCAPED_UNICODE);
    }

    public function errorMessage(string $message): string
    {
        return json_encode([
            "error" => [
                "message" => $message
            ]
        ], JSON_UNESCAPED_UNICODE);
    }
}