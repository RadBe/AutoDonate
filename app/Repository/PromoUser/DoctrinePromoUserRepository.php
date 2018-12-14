<?php


namespace App\Repository\PromoUser;


use App\Entity\PromoCode;
use App\Entity\PromoUser;
use App\Repository\DoctrineConstructor;

class DoctrinePromoUserRepository implements PromoUserRepository
{
    use DoctrineConstructor;

    public function findByPromoAndName(PromoCode $promo, string $name): ?PromoUser
    {
        return $this->er->createQueryBuilder('pu')
            ->where('pu.promo = :promo AND pu.name = :name')
            ->setParameter('promo', $promo)
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function create(PromoUser $promoUser): void
    {
        $this->em->persist($promoUser);
        $this->em->flush();
    }
}