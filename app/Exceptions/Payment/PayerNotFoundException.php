<?php


namespace App\Exceptions\Payment;


use App\Exceptions\UnexpectedValueException;

class PayerNotFoundException extends UnexpectedValueException
{
    public static function byName(string $name): PayerNotFoundException
    {
        return new PayerNotFoundException("Метод оплаты '$name' не найден!");
    }
}