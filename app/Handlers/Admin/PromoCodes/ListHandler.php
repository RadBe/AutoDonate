<?php


namespace App\Handlers\Admin\PromoCodes;


use App\Repository\PromoCode\PromoCodeRepository;

class ListHandler
{
    private $promoCodeRepository;

    public function __construct(PromoCodeRepository $promoCodeRepository)
    {
        $this->promoCodeRepository = $promoCodeRepository;
    }

    public function handle(): array
    {
        return $this->promoCodeRepository->getAll();
    }
}