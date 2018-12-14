<?php


namespace App;


use Illuminate\Support\Facades\Storage;

class Online
{
    private function __construct(){}

    public static function getOnline(): array
    {
        $storage = Storage::disk('local');

        $online = $storage->exists('monitoring/online.txt')
            ? explode(':', $storage->get('monitoring/online.txt'))
            : [0, 0];

        $record = $storage->exists('monitoring/record.txt')
            ? explode('|', $storage->get('monitoring/record.txt'))
            : [0, ''];

        return [$online, $record];
    }
}