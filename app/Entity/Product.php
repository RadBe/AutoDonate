<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="products", indexes={@ORM\Index(name="products_type_foreign", columns={"type"}), @ORM\Index(name="products_category_id_foreign", columns={"category_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Product
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false, options={"comment"="Название"})
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
     * @ORM\Column(name="data", type="text", length=65535, nullable=true, options={"comment"="Дополнительные данные"})
     */
    private $data;

    /**
     * @var array|null
     */
    private $jsonData = '';

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="created_at", type="datetime_immutable", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTimeImmutable|null
     *
     * @ORM\Column(name="updated_at", type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * Product constructor.
     *
     * @param Category $category
     * @param string $name
     * @param int $price
     * @param null|string $data
     */
    public function __construct(Category $category, string $name, int $price, ?string $data)
    {
        $this->category = $category;
        $this->name = $name;
        $this->price = $price;
        $this->data = $data;
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
     * @return Product
     */
    public function setName(string $name): Product
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
     * @param int $price
     * @return Product
     */
    public function setPrice(int $price): Product
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param Category $category
     * @return Product
     */
    public function setCategory(Category $category): Product
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param null|string $data
     * @return Product
     */
    public function setData(?string $data): Product
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

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
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
        $this->updatedAt = new \DateTimeImmutable();
    }
}