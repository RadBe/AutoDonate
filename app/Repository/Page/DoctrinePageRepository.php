<?php


namespace App\Repository\Page;


use App\Entity\Page;
use App\Repository\DoctrineClearCache;
use App\Repository\DoctrineConstructor;
use Doctrine\ORM\EntityManagerInterface;

class DoctrinePageRepository implements PageRepository
{
    use DoctrineConstructor, DoctrineClearCache;

    public function getAll(): array
    {
        return $this->er->createQueryBuilder('p')
            ->orderBy('p.slug', 'ASC')
            ->getQuery()
            ->useResultCache(true)
            ->getResult();
    }

    public function find(string $slug): ?Page
    {
        return $this->er->createQueryBuilder('p')
            ->where('p.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->useResultCache(true)
            ->getOneOrNullResult();
    }

    public function create(Page $page): void
    {
        $this->clearResultCache();

        $this->em->persist($page);
        $this->em->flush();
    }

    public function update(Page $page): void
    {
        $this->clearResultCache();

        $this->em->merge($page);
        $this->em->flush();
    }

    public function delete(Page $page): void
    {
        $this->clearResultCache();

        $this->em->remove($page);
        $this->em->flush();
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->em;
    }
}