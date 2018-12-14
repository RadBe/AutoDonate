<?php


namespace App\Handlers\Admin\Products;


use App\DataObjects\Product\SaveDataObject;
use App\Entity\Category;
use App\Entity\Product;
use App\Exceptions\Category\CategoryNotFoundException;
use App\Exceptions\Product\ProductNotFoundException;
use App\Repository\Category\CategoryRepository;
use App\Repository\Product\ProductRepository;

class EditHandler
{
    private $productRepository;

    private $categoryRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getProduct(int $id): Product
    {
        $product = $this->productRepository->find($id);
        if(is_null($product)) {
            throw new ProductNotFoundException($id);
        }

        return $product;
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

    public function handle(SaveDataObject $do, Product $product): void
    {
        $category = $this->getCategory($do->getCategoryId());

        $product->setCategory($category)
            ->setName($do->getName())
            ->setPrice($do->getPrice())
            ->setData(json_encode($do->getInputs()));

        $this->productRepository->update($product);
    }
}