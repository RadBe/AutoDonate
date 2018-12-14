<?php


namespace App\Handlers\Admin\Servers;


use App\Entity\Server;
use App\Exceptions\Server\ServerNotFoundException;
use App\Repository\Server\ServerRepository;

class DeleteHandler
{
    private $serverRepository;

    public function __construct(ServerRepository $serverRepository)
    {
        $this->serverRepository = $serverRepository;
    }

    public function getServer(int $id): Server
    {
        $server = $this->serverRepository->find($id);
        if(is_null($server)) {
            throw new ServerNotFoundException($id);
        }

        return $server;
    }

    public function handle(Server $server): void
    {
        $this->serverRepository->delete($server);
    }
}