<?php

namespace App\Providers;

use App\Services\Auth\Authenticator;
use App\Services\Auth\DefaultAuthenticator;
use App\Services\Auth\Session\Driver\CookieDriver;
use App\Services\Auth\Session\Driver\Driver;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Driver::class, CookieDriver::class);

        $this->app->singleton(Authenticator::class, DefaultAuthenticator::class);
    }
}
