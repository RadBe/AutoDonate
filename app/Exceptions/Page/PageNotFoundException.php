<?php


namespace App\Exceptions\Page;


use App\Exceptions\RuntimeException;

class PageNotFoundException extends RuntimeException
{
    public static function bySlug(string $slug): PageNotFoundException
    {
        return new self("Страница #$slug не найдена!");
    }
}