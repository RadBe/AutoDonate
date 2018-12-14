<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Purchase
 *
 * @ORM\Table(name="purchases")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Purchase
{
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
     * @ORM\Column(name="name", type="string", length=64, nullable=false, options={"comment"="Ник игрока"})
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer", nullable=false, options={"comment"="Цена"})
     */
    private $price;

    /**
     * @var string|null
     *
     * @ORM\Column(name="promo", type="string", length=255, nullable=true, options={"comment"="Промо-код"})
     */
    private $promo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="promo_discount", type="integer", nullable=true, options={"comment"="Скидка промо-кола"})
     */
    private $promoDiscount;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=42, nullable=false)
     */
    private $ip;

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="createdAt", type="datetime_immutable", nullable=false, options={"comment"="Создан"})
     */
    private $createdAt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="via", type="string", length=33, nullable=true, options={"comment"="С помощью чего оплачено"})
     */
    private $via;

    /**
     * @var \DateTimeImmutable|null
     *
     * @ORM\Column(name="completedAt", type="datetime_immutable", nullable=true, options={"comment"="Оплачен"})
     */
    private $completedAt;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * Purchase constructor.
     *
     * @param Product $product
     * @param string $name
     * @param int $price
     * @param null|string $promo
     * @param string $ip
     */
    public function __construct(Product $product, string $name, int $price, ?string $promo, string $ip)
    {
        $this->product = $product;
        $this->name = $name;
        $this->price = $price;
        $this->promo = $promo;
        $this->ip = $ip;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param null|string $promo
     */
    public function setPromo(?string $promo): void
    {
        $this->promo = $promo;
    }

    /**
     * @return null|string
     */
    public function getPromo(): ?string
    {
        return $this->promo;
    }

    /**
     * @param int|null $promoDiscount
     */
    public function setPromoDiscount(?int $promoDiscount): void
    {
        $this->promoDiscount = $promoDiscount;
    }

    /**
     * @return int|null
     */
    public function getPromoDiscount(): ?int
    {
        return $this->promoDiscount;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param null|string $via
     * @return Purchase
     */
    public function setVia(?string $via): Purchase
    {
        $this->via = $via;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getVia(): ?string
    {
        return $this->via;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getCompletedAt(): ?\DateTimeImmutable
    {
        return $this->completedAt;
    }

    /**
     * @return bool
     */
    public function isCompleted(): bool
    {
        return !is_null($this->via) && !is_null($this->completedAt);
    }

    /**
     * @ORM\PrePersist
     */
    public function generateCreatedAt(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    /**
     * @ORM\PreUpdate
     */
    public function generateUpdatedAt(): void
    {
        $this->completedAt = new \DateTimeImmutable();
    }
}