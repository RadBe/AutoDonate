<?php


namespace App\Services\Auth\Session;


class Session
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $role;

    /**
     * @var bool
     */
    private $init = false;

    /**
     * @param string $token
     * @param string $role
     * @return Session
     */
    public function init(string $token, string $role): Session
    {
        $this->token = $token;
        $this->role = $role;

        $this->init = true;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return bool
     */
    public function isInit(): bool
    {
        return $this->init;
    }
}