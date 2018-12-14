<?php


namespace App\Repository\PromoCode;


use App\Entity\PromoCode;

interface PromoCodeRepository
{
    public function getAll(): array;

    public function find(int $id): ?PromoCode;

    public function findByCode(string $code): PromoCode;

    public function create(PromoCode $promo): void;

    public function update(PromoCode $promo): void;

    public function delete(PromoCode $promo): void;
}