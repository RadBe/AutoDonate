<?php


namespace App\DataObjects\PromoCode;


class SaveDataObject
{
    /**
     * @var null|string
     */
    private $code;

    /**
     * @var int
     */
    private $discount;

    /**
     * @var int|null
     */
    private $amount;

    /**
     * @var null|string
     */
    private $dateBefore;

    /**
     * SaveDataObject constructor.
     *
     * @param null|string $code
     * @param int $discount
     * @param int|null $amount
     * @param null|string $dateBefore
     */
    public function __construct(?string $code, int $discount, ?int $amount, ?string $dateBefore)
    {
        $this->code = $code;
        $this->discount = $discount;
        $this->amount = $amount;
        $this->dateBefore = $dateBefore;
    }

    /**
     * @return null|string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function getDiscount(): int
    {
        return $this->discount;
    }

    /**
     * @return int|null
     */
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * @return null|string
     */
    public function getDateBefore(): ?string
    {
        return $this->dateBefore;
    }
}