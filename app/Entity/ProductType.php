<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * ProductType
 *
 * @ORM\Table(name="product_types", uniqueConstraints={@ORM\UniqueConstraint(name="product_types_type_unique", columns={"type"})})
 * @ORM\Entity
 */
class ProductType
{
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=32, nullable=false, options={"comment"="id"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false, options={"comment"="Отображаемое название"})
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="surcharge", type="boolean", nullable=false, options={"comment"="Включена ли доплата"})
     */
    private $surcharge;

    /**
     * @var string
     *
     * @ORM\Column(name="distributor", type="string", length=255, nullable=false, options={"comment"="Каким способом выдавать товар"})
     */
    private $distributor;

    /**
     * @var string|null
     *
     * @ORM\Column(name="data", type="text", length=65535, nullable=true, options={"comment"="Дополнительные данные"})
     */
    private $data;

    /**
     * @var array|null
     */
    private $jsonData = '';

    /**
     * ProductType constructor.
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
     * @param string $type
     * @return ProductType
     */
    public function setType(string $type): ProductType
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $name
     * @return ProductType
     */
    public function setName(string $name): ProductType
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param bool $surcharge
     * @return ProductType
     */
    public function setSurcharge(bool $surcharge): ProductType
    {
        $this->surcharge = $surcharge;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSurcharge(): bool
    {
        return $this->surcharge;
    }

    /**
     * @param string $distributor
     * @return ProductType
     */
    public function setDistributor(string $distributor): ProductType
    {
        $this->distributor = $distributor;

        return $this;
    }

    /**
     * @return string
     */
    public function getDistributor(): string
    {
        return $this->distributor;
    }

    /**
     * @param string|null $data
     * @return ProductType
     */
    public function setData(?string $data): ProductType
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getData(): ?string
    {
        return $this->data;
    }

    /**
     * @return array|null
     */
    public function getJsonData(): ?array
    {
        if($this->jsonData === '') {
            if(is_null($this->data)) {
                $this->jsonData = null;
            } else {
                $this->jsonData = json_decode($this->data, true);
            }
        }

        return $this->jsonData;
    }
}