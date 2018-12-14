<?php


namespace App\Repository\PromoCode;


use App\Entity\PromoCode;
use App\Repository\DoctrineConstructor;

class DoctrinePromoCodeRepository implements PromoCodeRepository
{
    use DoctrineConstructor;

    public function getAll(): array
    {
        return $this->er->findAll();
    }

    public function find(int $id): ?PromoCode
    {
        return $this->er->find($id);
    }

    public function findByCode(string $code): PromoCode
    {
        return $this->er->createQueryBuilder('pc')
            ->where('pc.code = :code')
            ->setParameter('code', $code)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function create(PromoCode $promo): void
    {
        $this->em->persist($promo);
        $this->em->flush();
    }

    public function update(PromoCode $promo): void
    {
        $this->em->merge($promo);
        $this->em->flush();
    }

    public function delete(PromoCode $promo): void
    {
        $this->em->remove($promo);
        $this->em->flush();
    }
}