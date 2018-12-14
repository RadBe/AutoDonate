<?php


namespace App\Handlers\Admin\Categories;


use App\Repository\Category\CategoryRepository;

class ListHandler
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategories(): array
    {
        return $this->categoryRepository->getAll(false);
    }
}