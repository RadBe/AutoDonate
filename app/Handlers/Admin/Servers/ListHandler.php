<?php


namespace App\Handlers\Admin\Servers;


use App\Repository\Server\ServerRepository;

class ListHandler
{
    private $serverRepository;

    public function __construct(ServerRepository $serverRepository)
    {
        $this->serverRepository = $serverRepository;
    }

    public function getServers(): array
    {
        return $this->serverRepository->getAll(false);
    }
}