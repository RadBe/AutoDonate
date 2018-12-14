<?php


namespace App\Services\Purchasing\Pipeline\Payment;


use App\DataObjects\Payment\PaymentPipelineObject;
use App\Services\Purchasing\Pipeline\PaymentPipeline;
use Closure;

class Validate implements PaymentPipeline
{
    public function handle(PaymentPipelineObject $payment, Closure $next)
    {
        $payment->getPayer()->validate($payment->getPurchase(), $payment->getData());

        return $next($payment);
    }
}