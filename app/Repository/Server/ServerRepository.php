<?php


namespace App\Repository\Server;


use App\Entity\Server;

interface ServerRepository
{
    public function getAll(bool $enabled = true): array;

    public function find(int $id): ?Server;

    public function create(Server $server): void;

    public function update(Server $server): void;

    public function delete(Server $server): void;
}