<?php


namespace App\Handlers\Admin\ProductTypes;


use App\Entity\ProductType;
use App\Exceptions\ProductType\ProductTypeNotFoundException;
use App\Repository\ProductType\ProductTypeRepository;

class DeleteHandler
{
    private $productTypeRepository;

    public function __construct(ProductTypeRepository $productTypeRepository)
    {
        $this->productTypeRepository = $productTypeRepository;
    }

    public function getType(string $id): ProductType
    {
        $type = $this->productTypeRepository->find($id);
        if(is_null($type)) {
            throw new ProductTypeNotFoundException($id);
        }

        return $type;
    }

    public function handle(ProductType $type): void
    {
        $this->productTypeRepository->delete($type);
    }
}