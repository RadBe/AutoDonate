<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * PromoUser
 *
 * @ORM\Table(name="promo_users", indexes={@ORM\Index(name="promo_users_promo_id_foreign", columns={"promo_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class PromoUser
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
     * @ORM\Column(name="name", type="string", length=64, nullable=false, options={"comment"="Игрок"})
     */
    private $name;

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="date", type="datetime_immutable", nullable=false, options={"comment"="Дата активации"})
     */
    private $date;

    /**
     * @var PromoCode
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\PromoCode")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="promo_id", referencedColumnName="id")
     * })
     */
    private $promo;

    public function __construct(PromoCode $promo, string $name)
    {
        $this->promo = $promo;
        $this->name = $name;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return PromoCode
     */
    public function getPromo(): PromoCode
    {
        return $this->promo;
    }

    /**
     * @ORM\PrePersist
     */
    public function generateDate(): void
    {
        $this->date = new \DateTimeImmutable();
    }
}