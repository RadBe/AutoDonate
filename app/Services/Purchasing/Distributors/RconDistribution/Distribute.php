<?php


namespace App\Services\Purchasing\Distributors\RconDistribution;


use App\Entity\Server;
use App\Services\Rcon\Connection;

class Distribute
{
    private $connections;

    public function __construct(Connections $connections)
    {
        $this->connections = $connections;
    }

    public function handle(Server $server, string $command): void
    {
        $connection = $this->getConnection($server);

        $connection->send($command, true);
    }

    private function getConnection(Server $server): Connection
    {
        return $this->connections->connect($server);
    }
}