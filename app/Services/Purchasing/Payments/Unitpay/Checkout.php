<?php


namespace App\Services\Purchasing\Payments\Unitpay;


class Checkout
{
    private const URL = 'https://unitpay.ru/pay';

    private $unitpayId;

    private $secret;

    public function __construct(string $unitpayId, string $secret)
    {
        $this->unitpayId = $unitpayId;
        $this->secret = $secret;
    }

    public function paymentUrl(Payment $payment): string
    {
        return self::URL . '/' . $this->unitpayId . '/qiwi?' . http_build_query($this->parseParams($payment));
    }

    public function getUnitpayId(): string
    {
        return $this->unitpayId;
    }

    public function getSecret(): string
    {
        return $this->secret;
    }

    public function validate(array $data): bool
    {
        $signature = $data['params']['signature'];
        $params = $data['params'];
        ksort($params);
        unset($params['sign']);
        unset($params['signature']);

        array_push($params, $this->getSecret());
        array_unshift($params, $data['method']);

        return $signature === hash('sha256', join('{up}', $params));
    }

    private function parseParams(Payment $payment): array
    {
        return [
            'account' => $payment->getPurchaseId(),
            'sum' => $payment->getCost(),
            'desc' => $payment->getDescription(),
            'hideMenu' => 'true',
            'operator' => 'qiwi'
        ];
    }
}