<?php


namespace App\Repository\Server;


use App\Entity\Server;
use App\Repository\DoctrineClearCache;
use App\Repository\DoctrineConstructor;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineServerRepository implements ServerRepository
{
    use DoctrineConstructor, DoctrineClearCache;

    public function getAll(bool $enabled = true): array
    {
        $query = $this->er->createQueryBuilder('s');

        if($enabled) {
            $query->where('s.enabled = 1');
        }

        return $query->getQuery()->useResultCache(true, 300)->getResult();
    }

    public function find(int $id): ?Server
    {
        return $this->er->find($id);
    }

    public function create(Server $server): void
    {
        $this->clearResultCache();

        $this->em->persist($server);
        $this->em->flush();
    }

    public function update(Server $server): void
    {
        $this->clearResultCache();

        $this->em->merge($server);
        $this->em->flush();
    }

    public function delete(Server $server): void
    {
        $this->clearResultCache();

        $this->em->remove($server);
        $this->em->flush();
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->em;
    }
}