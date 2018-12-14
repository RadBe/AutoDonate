<?php


namespace App\Exceptions\Payment;


use App\Exceptions\UnexpectedValueException;

class DistributorNotFoundException extends UnexpectedValueException
{
    public static function byClass(string $class): DistributorNotFoundException
    {
        return new DistributorNotFoundException("Дистрибьютор '$class' не найден!");
    }
}