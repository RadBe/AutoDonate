<?php


namespace App\Handlers\Admin\ProductTypes;


use App\DataObjects\ProductType\SaveDataObject;
use App\Entity\ProductType;
use App\Exceptions\ProductType\ProductTypeNotFoundException;
use App\Repository\ProductType\ProductTypeRepository;

class EditHandler
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

    public function handle(SaveDataObject $do, ProductType $type): void
    {
        $type->setName($do->getName())
            ->setSurcharge($do->isSurcharge())
            ->setDistributor($do->getDistributor())
            ->setData($do->getData());

        $this->productTypeRepository->update($type);
    }
}