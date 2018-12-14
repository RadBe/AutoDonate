<?php


namespace App\Services\Auth;


use App\Services\Auth\Session\Session;
use App\Services\Auth\Session\SessionPersistence;

class DefaultAuthenticator implements Authenticator
{
    /**
     * @var SessionPersistence
     */
    private $sessionPersistence;

    /**
     * @var Session
     */
    private $session;

    /**
     * DefaultAuthenticator constructor.
     *
     * @param SessionPersistence $sessionPersistence
     */
    public function __construct(SessionPersistence $sessionPersistence)
    {
        $this->sessionPersistence = $sessionPersistence;
    }

    /**
     * @param null|string $token
     * @return Session|null
     */
    public function authenticate(?string $token = null): Session
    {
        if(is_null($token)) {
            return $this->sessionPersistence->createFromStorage();
        }

        $role = config('site.users.' . $token);
        if(is_null($role)) {
            return new Session();
        }

        return $this->session = $this->sessionPersistence->createFromToken($token, $role);
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        $this->sessionPersistence->destroy();
    }

    /**
     * @return bool
     */
    public function check(): bool
    {
        $this->createSession();

        return $this->session->isInit();
    }

    /**
     * @return void
     */
    private function createSession(): void
    {
        if(is_null($this->session)) {
            $this->session = $this->sessionPersistence->createFromStorage();
        }
    }
}