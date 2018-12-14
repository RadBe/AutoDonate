<?php


namespace App\Handlers\Admin\Servers;


use App\DataObjects\Server\SaveDataObject;
use App\Entity\Server;
use App\Repository\Server\ServerRepository;

class CreateHandler
{
    private $serverRepository;

    public function __construct(ServerRepository $serverRepository)
    {
        $this->serverRepository = $serverRepository;
    }

    public function handle(SaveDataObject $do): void
    {
        $server = new Server(
            $do->getName(),
            $do->getRconIP(),
            $do->getRconPort(),
            $do->getRconPass(),
            $do->isEnabled()
        );

        $this->serverRepository->create($server);
    }
}