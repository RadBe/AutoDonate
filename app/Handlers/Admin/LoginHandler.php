<?php


namespace App\Handlers\Admin;


use App\Exceptions\RuntimeException;
use App\Services\Auth\Authenticator;

class LoginHandler
{
    private $authenticator;

    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    public function handle(string $token)
    {
        if(!$this->authenticator->authenticate($token)->isInit()) {
            throw new RuntimeException('Неправильный токен!');
        }
    }
}