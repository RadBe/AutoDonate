<?php


namespace App\Services\PromoCode;


interface Generator
{
    /**
     * @param int $length (1-64)
     * @return string
     */
    public function generate(int $length): string;
}