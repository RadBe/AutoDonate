<?php


namespace App\Handlers\Admin\PromoCodes;


use App\Entity\PromoCode;
use App\Exceptions\PromoCode\PromoCodeNotFoundException;
use App\Repository\PromoCode\PromoCodeRepository;

class DeleteHandler
{
    private $promoCodeRepository;

    public function __construct(PromoCodeRepository $promoCodeRepository)
    {
        $this->promoCodeRepository = $promoCodeRepository;
    }

    public function getPromo(int $id): PromoCode
    {
        $promo = $this->promoCodeRepository->find($id);
        if(is_null($promo)) {
            throw PromoCodeNotFoundException::byId($id);
        }

        return $promo;
    }

    public function handle(PromoCode $promo): void
    {
        $this->promoCodeRepository->delete($promo);
    }
}