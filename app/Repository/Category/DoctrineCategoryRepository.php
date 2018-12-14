<?php


namespace App\Repository\Category;


use App\Entity\Category;
use App\Repository\DoctrineClearCache;
use App\Repository\DoctrineConstructor;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineCategoryRepository implements CategoryRepository
{
    use DoctrineConstructor, DoctrineClearCache;

    public function getAll(bool $enabled = true): array
    {
        $query = $this->er->createQueryBuilder('c')
            ->select('c', 's')
            ->join('c.server', 's');

        if($enabled) {
            $query->where('s.enabled = 1');
        }

        return $query->getQuery()->useResultCache(true, 300)->getResult();
    }

    public function find(int $id): ?Category
    {
        return $this->er->find($id);
    }

    public function create(Category $category): void
    {
        $this->clearResultCache();

        $this->em->persist($category);
        $this->em->flush();
    }

    public function update(Category $category): void
    {
        $this->clearResultCache();

        $this->em->merge($category);
        $this->em->flush();
    }

    public function delete(Category $category): void
    {
        $this->clearResultCache();

        $this->em->remove($category);
        $this->em->flush();
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->em;
    }
}