<?php


namespace App\Services\Purchasing\Pipeline\Payment;


use App\DataObjects\Payment\PaymentPipelineObject;
use App\Entity\PromoUser;
use App\Exceptions\RuntimeException;
use App\Repository\PromoCode\PromoCodeRepository;
use App\Repository\PromoUser\PromoUserRepository;
use App\Services\Purchasing\Pipeline\PaymentPipeline;
use Closure;

class Promo implements PaymentPipeline
{
    private $promoRepository;

    private $promoUserRepository;

    public function __construct(PromoCodeRepository $promoCodeRepository, PromoUserRepository $promoUserRepository)
    {
        $this->promoRepository = $promoCodeRepository;
        $this->promoUserRepository = $promoUserRepository;
    }

    public function handle(PaymentPipelineObject $payment, Closure $next)
    {
        if(is_null($payment->getPurchase()->getPromo())) {
            return $next($payment);
        }

        $promo = $this->promoRepository->findByCode($payment->getPurchase()->getPromo());
        if(is_null($promo)) {
            $payment->getPurchase()->setPromo(null);
            $payment->getPurchase()->setPromoDiscount(null);

            return $next($payment);
        }

        if(!$promo->useable()) {
            throw new RuntimeException('Действие промо-кода истекло!');
        }

        $promo->use();
        $this->promoUserRepository->create(new PromoUser($promo, $payment->getPurchase()->getName()));

        return $next($payment);
    }
}