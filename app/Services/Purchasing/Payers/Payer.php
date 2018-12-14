<?php


namespace App\Services\Purchasing\Payers;


use App\Entity\Purchase;

interface Payer
{
    public function name(): string;

    public function purchaseId(array $data): int;

    public function paymentURL(Purchase $purchase, bool $surcharge): string;

    public function validate(Purchase $purchase, array $data): bool;

    public function successMessage(Purchase $purchase): string;

    public function errorMessage(string $message): string;
}