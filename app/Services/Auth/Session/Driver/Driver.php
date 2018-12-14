<?php


namespace App\Services\Auth\Session\Driver;


interface Driver
{
    public function get(): ?string;

    public function set(string $token): void;

    public function forget(): void;
}