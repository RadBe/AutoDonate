<?php


namespace App\Providers;


use App\Exceptions\UnexpectedValueException;
use App\Services\Purchasing\Distributors\Distributor;
use App\Services\Purchasing\Distributors\RconDistribution\Connections;
use App\Services\Purchasing\Payers\Payer;
use App\Services\Purchasing\Payers\UnitpayPayer;
use App\Services\Purchasing\Payments\Unitpay\Checkout as UnitpayCheckout;
use App\Services\Purchasing\Payers\Pool as PayerPool;
use App\Services\Purchasing\Distributors\Pool as DistributorPool;
use App\Services\Rcon\Connector;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class PurchaseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

    }

    public function register(): void
    {
        /* @var Repository $config */
        $config = $this->app->make(Repository::class);

        $this->app->singleton(UnitpayCheckout::class, function() use ($config) {
            return new UnitpayCheckout(
                $config->get('site.purchasing.unitpay.id'),
                $config->get('site.purchasing.unitpay.secret')
            );
        });

        $this->registerPayers();
        $this->registerPayerPool($config);
        $this->registerDistributorPool($config);

        $this->app->singleton(Connections::class, function (Application $app) {
            return new Connections($app->make(Connector::class));
        });
    }

    private function registerPayers(): void
    {
        $this->app->singleton(UnitpayPayer::class, function() {
            return new UnitpayPayer($this->app->make(UnitpayCheckout::class));
        });
    }

    private function registerPayerPool(Repository $config): void
    {
        $this->app->singleton(PayerPool::class, function() use ($config) {
            return new PayerPool(array_map(function($payer) {
                $instance = $this->app->make($payer);
                if($instance instanceof Payer) {
                    return $instance;
                }

                throw new UnexpectedValueException("Payer {$payer} must be implements interface App\Services\Purchasing\Payers\Payer");
            }, $config->get('site.purchasing.payers')));
        });
    }

    private function registerDistributorPool(Repository $config): void
    {
        $this->app->singleton(DistributorPool::class, function() use ($config) {
            return new DistributorPool(array_map(function($distributor) {
                $instance = $this->app->make($distributor);
                if($instance instanceof Distributor) {
                    return $instance;
                }

                throw new UnexpectedValueException("Distributor {$distributor} must be implements interface App\Services\Purchasing\Distributors\Distributor");
            }, $config->get('site.purchasing.distributors')));
        });
    }
}