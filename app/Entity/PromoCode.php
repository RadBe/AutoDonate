<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * PromoCode
 *
 * @ORM\Table(name="promo_codes", uniqueConstraints={@ORM\UniqueConstraint(name="promo_codes_code_unique", columns={"code"})})
 * @ORM\Entity
 */
class PromoCode
{
    public const CODE_LENGTH = 16;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=32, nullable=false, options={"comment"="Код"})
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(name="discount", type="integer", nullable=false, options={"unsigned"=true,"comment"="Скидка от 1 до 99"})
     */
    private $discount;

    /**
     * @var int|null
     *
     * @ORM\Column(name="amount", type="integer", nullable=true, options={"comment"="Количество активаций"})
     */
    private $amount;

    /**
     * @var \DateTimeImmutable|null
     *
     * @ORM\Column(name="activeBefore", type="datetime_immutable", nullable=true, options={"comment"="До какого числа активен"})
     */
    private $activeBefore;

    /**
     * PromoCode constructor.
     *
     * @param string $code
     * @param int $discount
     * @param int|null $amount
     * @param \DateTimeImmutable|null $activeBefore
     */
    public function __construct(string $code, int $discount, ?int $amount, ?\DateTimeImmutable $activeBefore)
    {
        $this->code = $code;
        $this->discount = $discount;
        $this->amount = $amount;
        $this->activeBefore = $activeBefore;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode(): string
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
     * @return bool
     */
    public function use(): bool
    {
        if(!is_null($this->amount) && $this->amount > 0) {
            --$this->amount;
            return true;
        }
        return false;
    }

    /**
     * @return int|null
     */
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getActiveBefore(): ?\DateTimeImmutable
    {
        return $this->activeBefore;
    }

    /**
     * @return bool
     */
    public function useable(): bool
    {
        return
            (is_null($this->activeBefore) || $this->activeBefore->getTimestamp() > time())
            &&
            (is_null($this->amount) || $this->amount > 0);
    }
}