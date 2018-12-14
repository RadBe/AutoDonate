<?php


namespace App\Exceptions\PromoCode;


use App\Exceptions\RuntimeException;

class PromoCodeNotFoundException extends RuntimeException
{
    public static function byId(int $id): PromoCodeNotFoundException
    {
        return new self("Промо-код #$id не найден!");
    }

    public static function byCode(string $code): PromoCodeNotFoundException
    {
        return new self("Промо-код #$code не найден!");
    }
}