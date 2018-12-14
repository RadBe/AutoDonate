<?php


namespace App\Services\Purchasing\Pipeline\Order;


use App\DataObjects\Payment\OrderPipelineObject;
use App\Entity\Purchase;
use App\Exceptions\RuntimeException;
use App\Repository\Purchase\PurchaseRepository;
use App\Services\Purchasing\Pipeline\OrderPipeline;
use Closure;

class Surcharge implements OrderPipeline
{
    private $purchaseRepository;

    public function __construct(PurchaseRepository $repository)
    {
        $this->purchaseRepository = $repository;
    }

    public function handle(OrderPipelineObject $order, Closure $next)
    {
        if(!$order->getPurchase()->getProduct()->getCategory()->getType()->isSurcharge()) {
            return $next($order);
        }

        /* @var Purchase $lastGroup */
        $lastGroup = $this->purchaseRepository->findLastGroup($order->getPurchase()->getName());

        if(is_null($lastGroup)) {
            return $next($order);
        }

        if($lastGroup->getProduct()->getId() == $order->getPurchase()->getProduct()->getId()) {
            throw new RuntimeException('Вы уже покупали эту группу ранее!');
        }

        $price = $order->getPurchase()->getPrice();

        if($lastGroup->getProduct()->getPrice() < $price) {
            $price -= $lastGroup->getPrice();
            if($price < 1) {
                throw new RuntimeException('Неправильная цена!');
            }
            $order->getPurchase()->setPrice($price);
            $order->setSurcharge(true);
        }

        return $next($order);
    }
}