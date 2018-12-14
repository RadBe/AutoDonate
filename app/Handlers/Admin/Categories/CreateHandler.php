<?php


namespace App\Handlers\Admin\Categories;


use App\DataObjects\Category\SaveDataObject;
use App\Entity\Category;
use App\Entity\ProductType;
use App\Entity\Server;
use App\Exceptions\ProductType\ProductTypeNotFoundException;
use App\Exceptions\Server\ServerNotFoundException;
use App\Repository\Category\CategoryRepository;
use App\Repository\ProductType\ProductTypeRepository;
use App\Repository\Server\ServerRepository;

class CreateHandler
{
    private $categoryRepository;

    private $serverRepository;

    private $productTypeRepository;

    public function __construct(CategoryRepository $cr, ServerRepository $sr, ProductTypeRepository $ptr)
    {
        $this->categoryRepository = $cr;
        $this->serverRepository = $sr;
        $this->productTypeRepository = $ptr;
    }

    public function getServers(): array
    {
        return $this->serverRepository->getAll(true);
    }

    public function getTypes(): array
    {
        return $this->productTypeRepository->getAll();
    }

    private function getServer(int $id): Server
    {
        $server = $this->serverRepository->find($id);
        if(is_null($server)) {
            throw new ServerNotFoundException($id);
        }

        return $server;
    }

    private function getType(string $name): ProductType
    {
        $type = $this->productTypeRepository->find($name);
        if(is_null($type)) {
            throw new ProductTypeNotFoundException($name);
        }

        return $type;
    }

    public function handle(SaveDataObject $do): void
    {
        $server = $this->getServer($do->getServerId());
        $type = $this->getType($do->getType());

        $category = new Category($server, $type, $do->getName(), $do->getWeight());

        $this->categoryRepository->create($category);
    }
}