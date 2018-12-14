<?php

namespace App\Services\Rcon;



use App\Exceptions\Rcon\AccessDenyException;
use App\Exceptions\Rcon\IdentifierDoNotMatch;

class DefaultConnection implements Connection
{
    const SERVERDATA_AUTH = 3;

    const SERVERDATA_AUTH_RESPONSE = 2;

    const SERVERDATA_EXECCOMMAND = 2;

    const SERVERDATA_RESPONSE_VALUE = 0;

    /**
     * @var Socket
     */
    private $socket;

    /**
     * @var mixed
     */
    private $last = null;

    /**
     * @param Socket $socket
     * @param string $password
     */
    public function __construct(Socket $socket, $password)
    {
        $this->socket = $socket;
        $this->auth($password);
    }

    /**
     * Make auth RCON - user request
     *
     * @param string $password
     *
     * @throws IdentifierDoNotMatch
     * @throws AccessDenyException
     *
     * @return bool
     */
    private function auth($password)
    {
        // The identifier serves to check the integrity of the response.
        // If the answer id matches the request id, then the answer is authentic.
        $id = $this->generateId();
        $this->socket->write($id, self::SERVERDATA_AUTH, $password);
        $response = $this->socket->read();

        if ($response['type'] === self::SERVERDATA_AUTH_RESPONSE) {
            if ($response['id'] === $id) {
                return true;
            }

            // If the identifiers do not match
            throw new IdentifierDoNotMatch($id, $response['id']);
        }

        throw new AccessDenyException();
    }

    /**
     * {@inheritdoc}
     */
    public function send($command, $getFullResponse = false)
    {
        // The identifier serves to check the integrity of the response.
        // If the answer id matches the request id, then the answer is authentic.
        $id = $this->generateId();
        if ($this->socket->write($id, self::SERVERDATA_EXECCOMMAND, $command)) {
            $response = $this->socket->read();

            if ($response['type'] === self::SERVERDATA_RESPONSE_VALUE) {
                if ($response['id'] === $id) {
                    $response['body'] = trim($response['body']);
                    $this->last = $response;
                    if ($getFullResponse) {
                        return $response;
                    }

                    return $this->last['body'];
                }

                // If the identifiers do not match
                throw new IdentifierDoNotMatch($id, $response['id']);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function last()
    {
        return $this->last;
    }

    /**
     * {@inheritdoc}
     */
    public function disconnect()
    {
        $this->socket->disconnect();
    }

    /**
     * Generates a random number
     *
     * @return int
     */
    private function generateId()
    {
        return mt_rand(1, 128);
    }
}
