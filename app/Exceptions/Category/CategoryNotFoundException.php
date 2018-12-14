<?php


namespace App\Exceptions\Category;


use Throwable;

class CategoryNotFoundException extends \RuntimeException
{
    public function __construct(int $id, int $code = 0, Throwable $previous = null)
    {
        $message = "Категория #$id не найдена!";
        parent::__construct($message, $code, $previous);
    }
}