<?php


namespace App\Services\Auth\Session\Driver;


use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Request;

class CookieDriver implements Driver
{
    private const COOKIE_NAME = 'autodonate_admin';

    private $request;

    private $cookie;

    public function __construct(Request $request, CookieJar $cookie)
    {
        $this->request = $request;
        $this->cookie = $cookie;
    }

    public function get(): ?string
    {
        return $this->request->cookie(static::COOKIE_NAME);
    }

    public function set(string $token): void
    {
        $this->cookie->queue($this->cookie->forever(static::COOKIE_NAME, $token));
    }

    public function forget(): void
    {
        $this->cookie->queue($this->cookie->forget(static::COOKIE_NAME));
    }
}