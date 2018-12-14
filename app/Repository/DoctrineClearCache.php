<?php


namespace App\Repository;


use Doctrine\ORM\EntityManagerInterface;

trait DoctrineClearCache
{
    protected function clearResultCache(): void
    {
        $cache = $this->getEntityManager()->getConfiguration()->getResultCacheImpl();
        if ($cache !== null && method_exists($cache, 'deleteAll')) {
            $cache->deleteAll();
        }
    }

    abstract protected function getEntityManager(): EntityManagerInterface;
}