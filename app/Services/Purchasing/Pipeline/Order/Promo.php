<?php


namespace App\Services\Purchasing\Pipeline\Order;


use App\DataObjects\Payment\OrderPipelineObject;
use App\Repository\PromoCode\PromoCodeRepository;
use App\Repository\PromoUser\PromoUserRepository;
use App\Services\Purchasing\Pipeline\OrderPipeline;
use Closure;

class Promo implements OrderPipeline
{
    private $promoRepository;

    private $promoUserRepository;

    public function __construct(PromoCodeRepository $promoCodeRepository, PromoUserRepository $promoUserRepository)
    {
        $this->promoRepository = $promoCodeRepository;
        $this->promoUserRepository = $promoUserRepository;
    }

    public function handle(OrderPipelineObject $order, Closure $next)
    {
        if(is_null($order->getPurchase()->getPromo())) {
            return $next($order);
        }

        $promo = $this->promoRepository->findByCode($order->getPurchase()->getPromo());
        if(is_null($promo)) {
            $order->getPurchase()->setPromo(null);
            return $next($order);
        }

        if(!$promo->useable()) {
            $order->getPurchase()->setPromo(null);
            return $next($order);
        }

        $promoUser = $this->promoUserRepository->findByPromoAndName($promo, $order->getPurchase()->getName());
        if(!is_null($promoUser)) {
            $order->getPurchase()->setPromo(null);
            return $next($order);
        }

        $order->getPurchase()->setPromo($promo->getCode());
        $order->getPurchase()->setPromoDiscount($promo->getDiscount());

        $price = $order->getPurchase()->getPrice();

        $price -= (int) ceil($price * ($promo->getDiscount()/100));

        $order->getPurchase()->setPrice($price);

        return $next($order);
    }
}