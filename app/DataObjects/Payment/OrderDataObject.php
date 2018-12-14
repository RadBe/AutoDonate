<?php


namespace App\DataObjects\Payment;


class OrderDataObject
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $productId;

    /**
     * @var null|string
     */
    private $promo;

    /**
     * OrderDataObject constructor.
     *
     * @param string $method
     * @param string $name
     * @param int $productId
     * @param null|string $promo
     */
    public function __construct(string $method, string $name, int $productId, ?string $promo)
    {
        $this->method = $method;
        $this->name = $name;
        $this->productId = $productId;
        $this->promo = $promo;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @return null|string
     */
    public function getPromo(): ?string
    {
        return $this->promo;
    }
}