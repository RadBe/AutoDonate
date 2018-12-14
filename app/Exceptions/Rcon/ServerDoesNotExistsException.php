<?php

namespace App\Exceptions\Rcon;

use Throwable;

class ServerDoesNotExistsException extends \RuntimeException
{
    public function __construct($server, $code = 0, Throwable $previous = null)
    {
        $message = "Server with name \"{$server}\" does not exists in the server pool";

        parent::__construct($message, $code, $previous);
    }
}
