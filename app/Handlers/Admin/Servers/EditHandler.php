<?php


namespace App\Handlers\Admin\Servers;


use App\DataObjects\Server\SaveDataObject;
use App\Entity\Server;
use App\Exceptions\Server\ServerNotFoundException;
use App\Repository\Server\ServerRepository;

class EditHandler
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

    public function handle(SaveDataObject $do, Server $server): void
    {
        $server->setName($do->getName())
            ->setRconIP($do->getRconIP())
            ->setRconPort($do->getRconPort())
            ->setRconPass($do->getRconPass())
            ->setEnabled($do->isEnabled());

        $this->serverRepository->update($server);
    }
}