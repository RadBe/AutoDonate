<?php


namespace App\Repository\Category;


use App\Entity\Category;

interface CategoryRepository
{
    public function getAll(bool $enabled = true): array;

    public function find(int $id): ?Category;

    public function create(Category $category): void;

    public function update(Category $category): void;

    public function delete(Category $category): void;
}