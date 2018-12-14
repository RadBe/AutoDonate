<?php


namespace App\Repository\ProductType;


use App\Entity\ProductType;

interface ProductTypeRepository
{
    public function getAll(): array;

    public function find(string $id): ?ProductType;

    public function create(ProductType $type): void;

    public function update(ProductType $type): void;

    public function delete(ProductType $type): void;
}