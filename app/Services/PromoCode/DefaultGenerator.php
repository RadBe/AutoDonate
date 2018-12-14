<?php


namespace App\Services\PromoCode;


class DefaultGenerator implements Generator
{
    public function generate(int $length): string
    {
        return str_random($length);
    }
}