<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Server
 *
 * @ORM\Table(name="servers")
 * @ORM\Entity
 */
class Server
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
     * @var string
     *
     * @ORM\Column(name="rcon_ip", type="string", length=16, nullable=false, options={"comment"="Rcon-IP"})
     */
    private $rconIP;

    /**
     * @var int
     *
     * @ORM\Column(name="rcon_port", type="integer", nullable=false, options={"comment"="Rcon-Порт"})
     */
    private $rconPort;

    /**
     * @var string
     *
     * @ORM\Column(name="rcon_pass", type="string", length=255, nullable=false, options={"comment"="Rcon-Пароль"})
     */
    private $rconPass;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false, options={"comment"="Отображение сервера в списке"})
     */
    private $enabled = false;

    /**
     * Server constructor.
     *
     * @param string $name
     * @param string $rconIP
     * @param int $rconPort
     * @param string $rconPass
     * @param bool $enabled
     */
    public function __construct(string $name, string $rconIP, int $rconPort, string $rconPass, bool $enabled)
    {
        $this->name = $name;
        $this->rconIP = $rconIP;
        $this->rconPort = $rconPort;
        $this->rconPass = $rconPass;
        $this->enabled = $enabled;
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
     * @return Server
     */
    public function setName(string $name): Server
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
     * @param string $rconIP
     * @return Server
     */
    public function setRconIP(string $rconIP): Server
    {
        $this->rconIP = $rconIP;

        return $this;
    }

    /**
     * @return string
     */
    public function getRconIP(): string
    {
        return $this->rconIP;
    }

    /**
     * @param int $rconPort
     * @return Server
     */
    public function setRconPort(int $rconPort): Server
    {
        $this->rconPort = $rconPort;

        return $this;
    }

    /**
     * @return int
     */
    public function getRconPort(): int
    {
        return $this->rconPort;
    }

    /**
     * @param string $rconPass
     * @return Server
     */
    public function setRconPass(string $rconPass): Server
    {
        $this->rconPass = $rconPass;

        return $this;
    }

    /**
     * @return string
     */
    public function getRconPass(): string
    {
        return $this->rconPass;
    }

    /**
     * @param bool $enabled
     * @return Server
     */
    public function setEnabled(bool $enabled): Server
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}