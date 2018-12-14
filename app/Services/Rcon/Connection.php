<?php

namespace App\Services\Rcon;



use App\Exceptions\RuntimeException;

interface Connection
{
    /**
     * Send command.
     *
     * @param string $command
     * @param bool   $getFullResponse
     *
     * @throws RuntimeException
     *
     * @return string|array|null
     */
    public function send($command, $getFullResponse = false);

    /**
     * Returns last response or null.
     *
     * @return mixed
     */
    public function last();

    /**
     * Disconnect from RCON.
     */
    public function disconnect();
}
