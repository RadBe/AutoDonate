<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 *
 * @ORM\Table(name="pages", uniqueConstraints={@ORM\UniqueConstraint(name="pages_slug_unique", columns={"slug"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Page
{
    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100, nullable=false, options={"comment"="Ссылка"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false, options={"comment"="Описание"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=0, nullable=false, options={"comment"="Содержимое"})
     */
    private $content;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * Page constructor.
     *
     * @param string $slug
     * @param string $title
     * @param string $content
     */
    public function __construct(string $slug, string $title, string $content)
    {
        $this->slug = $slug;
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $title
     * @return Page
     */
    public function setTitle(string $title): Page
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $content
     * @return Page
     */
    public function setContent(string $content): Page
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
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