<?php


namespace App\Repository\PromoUser;


use App\Entity\PromoCode;
use App\Entity\PromoUser;

interface PromoUserRepository
{
    public function findByPromoAndName(PromoCode $promo, string $name): ?PromoUser;

    public function create(PromoUser $promoUser): void;
}