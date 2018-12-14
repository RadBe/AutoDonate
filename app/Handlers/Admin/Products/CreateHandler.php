<?php


namespace App\Handlers\Admin\Products;


use App\DataObjects\Product\SaveDataObject;
use App\Entity\Category;
use App\Entity\Product;
use App\Exceptions\Category\CategoryNotFoundException;
use App\Repository\Category\CategoryRepository;
use App\Repository\Product\ProductRepository;

class CreateHandler
{
    private $productRepository;

    private $categoryRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategories(): array
    {
        return $this->categoryRepository->getAll(true);
    }

    public function getCategory(int $id): Category
    {
        $category = $this->categoryRepository->find($id);
        if(is_null($category)) {
            throw new CategoryNotFoundException($id);
        }

        return $category;
    }

    public function handle(SaveDataObject $do, Category $category): void
    {
        $product = new Product($category, $do->getName(), $do->getPrice(), json_encode($do->getInputs()));

        $this->productRepository->create($product);
    }
}