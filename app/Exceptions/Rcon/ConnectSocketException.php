<?php

namespace App\Exceptions\Rcon;


class ConnectSocketException extends \RuntimeException
{
    /**
     * @param string          $host   RCON host
     * @param int             $ip     RCON port
     * @param int             $errno  Error number
     * @param string          $errstr Error description string
     * @param int             $code
     * @param \Exception|null $previous
     */
    public function __construct($host, $ip, $errno, $errstr, $code = 0, \Exception $previous = null)
    {
        parent::__construct("Could not connect to socket {$host}:{$ip}", $code, $previous);
    }
}
