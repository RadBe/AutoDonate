<?php


namespace App\Repository\Product;


use App\Entity\Product;

interface ProductRepository
{
    public function getAll(): array;

    public function find(int $id): ?Product;

    public function create(Product $product): void;

    public function update(Product $product): void;

    public function delete(Product $product): void;
}