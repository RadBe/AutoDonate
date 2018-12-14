<?php


namespace App\Exceptions\Purchase;


use App\Exceptions\UnexpectedValueException;
use Throwable;

class PurchaseNotFoundException extends UnexpectedValueException
{
    public function __construct(int $id, int $code = 0, Throwable $previous = null)
    {
        $message = "Платёж #$id не найден!";
        parent::__construct($message, $code, $previous);
    }
}