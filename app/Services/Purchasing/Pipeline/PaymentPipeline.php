<?php


namespace App\Services\Purchasing\Pipeline;


use App\DataObjects\Payment\PaymentPipelineObject;
use Closure;

interface PaymentPipeline
{
    public function handle(PaymentPipelineObject $payment, Closure $next);
}