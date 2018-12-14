<?php


namespace App\Repository\Purchase;


use App\Entity\Purchase;
use App\Repository\PaginatedDoctrineConstructor;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class DoctrinePurchaseRepository implements PurchaseRepository
{
    use PaginatedDoctrineConstructor, PaginatesFromParams;

    public function getAll(int $page, int $perPage = 30): LengthAwarePaginator
    {
        return $this->paginate(
            $this->createQueryBuilder('p')
                ->orderBy('p.id', 'DESC')
                ->getQuery(),
            $perPage,
            $page,
            false
        );
    }

    public function getAllPayed(int $page, ?string $player = null, int $perPage = 30): LengthAwarePaginator
    {
        $query = $this->createQueryBuilder('p');
        if(!is_null($player)) {
            $query->where('p.name = :player AND p.via IS NOT NULL AND p.completedAt IS NOT NULL')
                ->setParameter('player', $player);
        } else {
            $query->where('p.via IS NOT NULL AND p.completedAt IS NOT NULL');
        }

        $query->orderBy('p.id', 'DESC');

        return $this->paginate(
            $query->getQuery(),
            $perPage,
            $page,
            false
        );
    }

    public function getAllNotPayed(int $page, ?string $player = null, int $perPage = 30): LengthAwarePaginator
    {
        $query = $this->createQueryBuilder('p');
        if(!is_null($player)) {
            $query->where('p.name = :player AND p.via IS NULL AND p.completedAt IS NULL')
                ->setParameter('player', $player);
        } else {
            $query->where('p.via IS NULL AND p.completedAt IS NULL');
        }

        $query->orderBy('p.id', 'DESC');

        return $this->paginate(
            $query->getQuery(),
            $perPage,
            $page,
            false
        );
    }

    public function find(int $id): ?Purchase
    {
        return $this->er->find($id);
    }

    public function findByName(string $name): array
    {
        return $this->er->createQueryBuilder('p')
            ->where('p.name = :name')
            ->setParameter('name', $name)
            ->orderBy('id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findLastGroup(string $name): ?Purchase
    {
        return $this->er->createQueryBuilder('p')
            ->select('p', 'prod', 'cat')
            ->join('p.product', 'prod')
            ->join('prod.category', 'cat')
            ->where('p.name = :name AND cat.type = :group AND p.via IS NOT NULL AND p.completedAt IS NOT NULL') //TODO: via not in [@admin]
            ->setParameter('name', $name)
            ->setParameter('group', 'group')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function create(Purchase $purchase): void
    {
        $this->em->persist($purchase);
        $this->em->flush();
    }

    public function update(Purchase $purchase): void
    {
        $this->em->merge($purchase);
        $this->em->flush();
    }
}