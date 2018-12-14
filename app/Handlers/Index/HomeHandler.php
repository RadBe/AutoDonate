<?php


namespace App\Handlers\Index;


use App\Repository\Product\ProductRepository;

class HomeHandler
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