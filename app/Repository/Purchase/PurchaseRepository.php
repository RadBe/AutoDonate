<?php


namespace App\Repository\Purchase;


use App\Entity\Purchase;
use Illuminate\Pagination\LengthAwarePaginator;

interface PurchaseRepository
{
    public function getAll(int $page, int $perPage = 30): LengthAwarePaginator;

    public function getAllPayed(int $page, ?string $player = null, int $perPage = 30): LengthAwarePaginator;

    public function getAllNotPayed(int $page, ?string $player = null, int $perPage = 30): LengthAwarePaginator;

    public function find(int $id): ?Purchase;

    public function findByName(string $name): array;

    public function findLastGroup(string $name): ?Purchase;

    public function create(Purchase $purchase): void;

    public function update(Purchase $purchase): void;
}