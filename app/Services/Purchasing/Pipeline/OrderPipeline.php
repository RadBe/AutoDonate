<?php


namespace App\Services\Purchasing\Pipeline;


use App\DataObjects\Payment\OrderPipelineObject;
use Closure;

interface OrderPipeline
{
    public function handle(OrderPipelineObject $order, Closure $next);
}