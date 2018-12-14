<?php


namespace App\DataObjects\ProductType;


class SaveDataObject
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $surcharge;

    /**
     * @var string
     */
    private $distributor;

    /**
     * @var null|string
     */
    private $data;

    /**
     * SaveDataObject constructor.
     *
     * @param string $type
     * @param string $name
     * @param bool $surcharge
     * @param string $distributor
     * @param null|string $data
     */
    public function __construct(string $type, string $name, bool $surcharge, string $distributor, ?string $data)
    {
        $this->type = $type;
        $this->name = $name;
        $this->surcharge = $surcharge;
        $this->distributor = $distributor;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isSurcharge(): bool
    {
        return $this->surcharge;
    }

    /**
     * @return string
     */
    public function getDistributor(): string
    {
        return $this->distributor;
    }

    /**
     * @return null|string
     */
    public function getData(): ?string
    {
        return $this->data;
    }
}