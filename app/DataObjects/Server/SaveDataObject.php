<?php


namespace App\DataObjects\Server;


class SaveDataObject
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $rconIP;

    /**
     * @var int
     */
    private $rconPort;

    /**
     * @var string
     */
    private $rconPass;

    /**
     * @var bool
     */
    private $enabled;

    /**
     * SaveDataObject constructor.
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getRconIP(): string
    {
        return $this->rconIP;
    }

    /**
     * @return int
     */
    public function getRconPort(): int
    {
        return $this->rconPort;
    }

    /**
     * @return string
     */
    public function getRconPass(): string
    {
        return $this->rconPass;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}