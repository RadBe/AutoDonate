<?php


namespace App\Services\Auth\Session;


use App\Services\Auth\Session\Driver\Driver;

class SessionPersistence
{
    /**
     * @var Driver
     */
    private $driver;

    /**
     * SessionPersistence constructor.
     *
     * @param Driver $driver
     */
    public function __construct(Driver $driver)
    {
        $this->driver = $driver;
    }

    /**
     * @param string $token
     * @param string $role
     * @return Session
     */
    public function createFromToken(string $token, string $role): Session
    {
        $this->driver->set($token);

        return (new Session())->init($token, $role);
    }

    /**
     * @return Session
     */
    public function createFromStorage(): Session
    {
        $token = $this->driver->get();
        if(is_null($token)) {
            return $this->createEmpty();
        }

        $role = config('site.users.' . $token);
        if(is_null($role)) {
            return $this->createEmpty();
        }

        return (new Session())->init($token, $role);
    }

    /**
     * @return void
     */
    public function destroy(): void
    {
        $this->driver->forget();
    }

    /**
     * @return Session
     */
    private function createEmpty(): Session
    {
        return new Session();
    }
}