<?php


namespace App\Handlers\Admin\PromoCodes;


use App\DataObjects\PromoCode\SaveDataObject;
use App\Entity\PromoCode;
use App\Exceptions\RuntimeException;
use App\Repository\PromoCode\PromoCodeRepository;
use App\Services\PromoCode\Generator;

class CreateHandler
{
    private $promoCodeRepository;

    private $generator;

    public function __construct(PromoCodeRepository $promoCodeRepository, Generator $generator)
    {
        $this->promoCodeRepository = $promoCodeRepository;
        $this->generator = $generator;
    }

    public function handle(SaveDataObject $do): void
    {
        $code = $do->getCode() ?: $this->generator->generate(PromoCode::CODE_LENGTH);

        $date = $do->getDateBefore();
        if(!is_null($date)) {
            try {
                $date = new \DateTimeImmutable($date);
            } catch (\Exception $exception) {
                throw new RuntimeException($exception);
            }
        }

        $this->promoCodeRepository->create(new PromoCode($code, $do->getDiscount(), $do->getAmount(), $date));
    }
}