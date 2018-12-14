<?php


namespace App\Repository\Page;


use App\Entity\Page;

interface PageRepository
{
    public function getAll(): array;

    public function find(string $slug): ?Page;

    public function create(Page $page): void;

    public function update(Page $page): void;

    public function delete(Page $page): void;
}