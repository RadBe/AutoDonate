<?php

namespace App\Providers;

use App\Services\PromoCode\DefaultGenerator;
use App\Services\PromoCode\Generator;
use App\Services\Rcon\Connector;
use App\Services\Rcon\DefaultConnector;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Generator::class, DefaultGenerator::class);
        $this->app->singleton(Connector::class, DefaultConnector::class);
    }
}
