<?php


namespace App\Repository;


trait PaginatedDoctrineConstructor
{
    use DoctrineConstructor;

    public function createQueryBuilder($alias, $indexBy = null)
    {
        return $this->er->createQueryBuilder($alias, $indexBy);
    }
}