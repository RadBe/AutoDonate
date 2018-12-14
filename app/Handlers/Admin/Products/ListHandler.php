<?php


namespace App\Handlers\Admin\Products;


use App\Repository\Product\ProductRepository;

class ListHandler
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProducts(): array
    {
        return $this->productRepository->getAll();
    }
}