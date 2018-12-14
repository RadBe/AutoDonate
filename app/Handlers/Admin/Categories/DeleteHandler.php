<?php


namespace App\Handlers\Admin\Categories;


use App\Entity\Category;
use App\Exceptions\Category\CategoryNotFoundException;
use App\Repository\Category\CategoryRepository;

class DeleteHandler
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategory(int $id): Category
    {
        $category = $this->categoryRepository->find($id);
        if(is_null($category)) {
            throw new CategoryNotFoundException($id);
        }

        return $category;
    }

    public function handle(Category $category): void
    {
        $this->categoryRepository->delete($category);
    }
}