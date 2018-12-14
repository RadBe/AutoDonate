<?php


namespace App\Repository\ProductType;


use App\Entity\ProductType;
use App\Repository\DoctrineClearCache;
use App\Repository\DoctrineConstructor;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineProductTypeRepository implements ProductTypeRepository
{
    use DoctrineConstructor, DoctrineClearCache;

    public function getAll(): array
    {
        return $this->er->findAll();
    }

    public function find(string $id): ?ProductType
    {
        return $this->er->find($id);
    }

    public function create(ProductType $type): void
    {
        $this->clearResultCache();

        $this->em->persist($type);
        $this->em->flush();
    }

    public function update(ProductType $type): void
    {
        $this->clearResultCache();

        $this->em->merge($type);
        $this->em->flush();
    }

    public function delete(ProductType $type): void
    {
        $this->clearResultCache();

        $this->em->remove($type);
        $this->em->flush();
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->em;
    }
}