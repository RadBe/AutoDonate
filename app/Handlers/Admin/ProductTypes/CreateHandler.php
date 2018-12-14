<?php


namespace App\Handlers\Admin\ProductTypes;


use App\DataObjects\ProductType\SaveDataObject;
use App\Entity\ProductType;
use App\Repository\ProductType\ProductTypeRepository;

class CreateHandler
{
    private $productTypeRepository;

    public function __construct(ProductTypeRepository $productTypeRepository)
    {
        $this->productTypeRepository = $productTypeRepository;
    }

    public function handle(SaveDataObject $do): void
    {
        $type = new ProductType(
            $do->getType(),
            $do->getName(),
            $do->isSurcharge(),
            $do->getDistributor(),
            $do->getData()
        );

        $this->productTypeRepository->create($type);
    }
}