<?php


namespace App;


class NavMenu
{
    public static $active = 'index';

    public static function active_tab(string $name): string
    {
        return self::$active == $name ? 'active' : '';
    }
}