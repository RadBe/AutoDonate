<?php


namespace App\Exceptions\Server;


use Throwable;

class ServerNotFoundException extends \RuntimeException
{
    public function __construct(int $id, int $code = 0, Throwable $previous = null)
    {
        $message = "Сервер #$id не найден!";
        parent::__construct($message, $code, $previous);
    }
}