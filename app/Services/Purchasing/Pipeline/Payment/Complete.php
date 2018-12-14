<?php


namespace App\Services\Purchasing\Pipeline\Payment;


use App\DataObjects\Payment\PaymentPipelineObject;
use App\Exceptions\Payment\DistributorNotFoundException;
use App\Repository\Purchase\PurchaseRepository;
use App\Services\Purchasing\Distributors\Distributor;
use App\Services\Purchasing\Distributors\Pool;
use App\Services\Purchasing\Pipeline\PaymentPipeline;
use Closure;

class Complete implements PaymentPipeline
{
    private $purchaseRepository;

    private $pool;

    public function __construct(PurchaseRepository $purchaseRepository, Pool $pool)
    {
        $this->purchaseRepository = $purchaseRepository;
        $this->pool = $pool;
    }

    private function getDistributor(string $class): Distributor
    {
        $distributor = $this->pool->find($class);
        if(is_null($distributor)) {
            throw DistributorNotFoundException::byClass($class);
        }

        return $distributor;
    }

    private function viaFormat(string $method): string
    {
        return '@' . $method;
    }

    public function handle(PaymentPipelineObject $payment, Closure $next)
    {
        $distributor = $this->getDistributor($payment->getPurchase()->getProduct()->getCategory()->getType()->getDistributor());

        $via = $this->viaFormat($payment->getPayer()->name());

        $distributor->distribute($payment->getPurchase());

        $payment->getPurchase()->setVia($via);

        $this->purchaseRepository->update($payment->getPurchase());

        return $next($payment);
    }
}