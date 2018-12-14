<?php


namespace App\DataObjects\Product;


class SaveDataObject
{
    /**
     * @var int
     */
    private $categoryId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $price;

    /**
     * @var array
     */
    private $inputs = [];

    /**
     * SaveDataObject constructor.
     *
     * @param int $categoryId
     * @param string $name
     * @param int $price
     * @param array $inputs
     */
    public function __construct(int $categoryId, string $name, int $price, array $inputs)
    {
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->price = $price;
        $this->inputs = $inputs;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
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
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return array
     */
    public function getInputs(): array
    {
        return $this->inputs;
    }
}