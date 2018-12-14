<?php


namespace App\Handlers\Admin\Products;


use App\Entity\Product;
use App\Exceptions\Product\ProductNotFoundException;
use App\Repository\Product\ProductRepository;

class DeleteHandler
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProduct(int $id): Product
    {
        $product = $this->productRepository->find($id);
        if(is_null($product)) {
            throw new ProductNotFoundException($id);
        }

        return $product;
    }

    public function handle(Product $product): void
    {
        $this->productRepository->delete($product);
    }
}