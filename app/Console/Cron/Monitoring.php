<?php


namespace App\Console\Cron;


use App\Exceptions\MineQuery\QueryException;
use App\Services\MineQuery\Query;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Monitoring extends Command
{
    protected $signature = 'site:monitoring';

    public function handle(): void
    {
        $storage = Storage::disk('local');

        $ip = config('site.monitoring.ip');
        $port = config('site.monitoring.port');

        $query = new Query();

        try {
            $query->Connect($ip, $port);

            $info = $query->GetInfo();

            $online = (int) $info['Players'];

            $slots = (int) $info['MaxPlayers'];

            $record = $storage->exists('monitoring/record.txt')
                ? (int)explode('|', $storage->get('monitoring/record.txt'))[0]
                : 0;

            if($online > $record) {
                $storage->put('monitoring/record.txt', "$online|" . Carbon::now()->format('d.m.Y H:i'));
            }

            $storage->put('monitoring/online.txt', "$online:$slots");
        } catch (QueryException $exception) {
            Log::error($exception);
        }
    }
}