<?php


namespace App\Repository\Product;


use App\Entity\Product;
use App\Repository\DoctrineClearCache;
use App\Repository\DoctrineConstructor;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineProductRepository implements ProductRepository
{
    use DoctrineConstructor, DoctrineClearCache;

    public function getAll(): array
    {
        return $this->er->createQueryBuilder('p')
            ->select('p', 'c', 's')
            ->join('p.category', 'c')
            ->join('c.server', 's')
            ->where('s.enabled = 1')
            ->addOrderBy('c.weight', 'ASC')
            ->addOrderBy('p.price', 'ASC')
            ->addOrderBy('p.category', 'DESC')
            ->getQuery()
            ->useResultCache(true, 300)
            ->getResult();
    }

    public function find(int $id): ?Product
    {
        return $this->er->find($id);
    }

    public function create(Product $product): void
    {
        $this->clearResultCache();

        $this->em->persist($product);
        $this->em->flush();
    }

    public function update(Product $product): void
    {
        $this->clearResultCache();

        $this->em->merge($product);
        $this->em->flush();
    }

    public function delete(Product $product): void
    {
        $this->clearResultCache();

        $this->em->remove($product);
        $this->em->flush();
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->em;
    }
}