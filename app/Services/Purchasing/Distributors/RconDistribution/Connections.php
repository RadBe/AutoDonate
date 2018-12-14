<?php


namespace App\Services\Purchasing\Distributors\RconDistribution;


use App\Entity\Server;
use App\Services\Rcon\Connection;
use App\Services\Rcon\Connector;

class Connections
{
    private const TIMEOUT = 3;

    private $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    public function connect(Server $server): Connection
    {
        if ($this->connector->exists($server->getId())) {
            return $this->connector->get($server->getId());
        }

        $this->connector->add(
            $server->getId(),
            $server->getRconIP(),
            $server->getRconPort(),
            $server->getRconPass(),
            self::TIMEOUT
        );

        return $this->connector->get($server->getId());
    }
}