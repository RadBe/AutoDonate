<?php


namespace App\DataObjects\Category;


class SaveDataObject
{
    /**
     * @var int
     */
    private $serverId;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $weight;

    /**
     * SaveDataObject constructor.
     *
     * @param int $serverId
     * @param string $type
     * @param string $name
     * @param int $weight
     */
    public function __construct(int $serverId, string $type, string $name, int $weight)
    {
        $this->serverId = $serverId;
        $this->type = $type;
        $this->name = $name;
        $this->weight = $weight;
    }

    /**
     * @return int
     */
    public function getServerId(): int
    {
        return $this->serverId;
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
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }
}