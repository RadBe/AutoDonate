<?php


namespace App\Handlers\Admin\ProductTypes;


use App\Repository\ProductType\ProductTypeRepository;

class ListHandler
{
    private $productTypeRepository;

    public function __construct(ProductTypeRepository $productTypeRepository)
    {
        $this->productTypeRepository = $productTypeRepository;
    }

    public function getProductTypes(): array
    {
        return $this->productTypeRepository->getAll();
    }
}