<?php


namespace App\Services\Auth;


use App\Services\Auth\Session\Session;

interface Authenticator
{
    /**
     * @param null|string $token
     * @return Session
     */
    public function authenticate(?string $token = null): Session;

    /**
     * @return void
     */
    public function logout(): void;

    /**
     * @return bool
     */
    public function check(): bool;
}