<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="categories", indexes={@ORM\Index(name="categories_server_id_foreign", columns={"server_id"})})
 * @ORM\Entity
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false, options={"comment"="Отображаемое название"})
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="weight", type="integer", nullable=false, options={"comment"="Вес категории (для сортировки)"})
     */
    private $weight;

    /**
     * @var Server
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Server")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="server_id", referencedColumnName="id")
     * })
     */
    private $server;

    /**
     * @var ProductType
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type", referencedColumnName="type")
     * })
     */
    private $type;

    /**
     * Category constructor.
     *
     * @param Server $server
     * @param ProductType $type
     * @param string $name
     * @param int $weight
     */
    public function __construct(Server $server, ProductType $type, string $name, int $weight)
    {
        $this->server = $server;
        $this->type = $type;
        $this->name = $name;
        $this->weight = $weight;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $name
     * @return Category
     */
    public function setName(string $name): Category
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
     * @param Server $server
     * @return Category
     */
    public function setServer(Server $server): Category
    {
        $this->server = $server;

        return $this;
    }

    /**
     * @return Server
     */
    public function getServer(): Server
    {
        return $this->server;
    }

    /**
     * @param ProductType $type
     * @return Category
     */
    public function setType(ProductType $type): Category
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return ProductType
     */
    public function getType(): ProductType
    {
        return $this->type;
    }

    /**
     * @param int $weight
     * @return Category
     */
    public function setWeight(int $weight): Category
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }
}