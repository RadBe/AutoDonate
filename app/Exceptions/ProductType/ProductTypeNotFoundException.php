<?php


namespace App\Exceptions\ProductType;


use Throwable;

class ProductTypeNotFoundException extends \RuntimeException
{
    public function __construct(string $name, int $code = 0, Throwable $previous = null)
    {
        $message = "Тип #$name не найден!";
        parent::__construct($message, $code, $previous);
    }
}