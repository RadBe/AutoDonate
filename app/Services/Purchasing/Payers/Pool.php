<?php


namespace App\Services\Purchasing\Payers;


class Pool
{
    /**
     * @var Payer[]
     */
    private $payers;

    /**
     * Pool constructor.
     *
     * @param array $payers
     */
    public function __construct(array $payers)
    {
        $this->payers = $payers;
    }

    /**
     * @param string $name
     * @return Payer|null
     */
    public function retrieveByName(string $name): ?Payer
    {
        foreach ($this->payers as $payer) {
            if ($payer->name() === $name) {
                return $payer;
            }
        }

        return null;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->payers;
    }

    /**
     * @return array
     */
    public function allEnabled(): array
    {
        $result = [];
        foreach ($this->payers as $payer) {
            if ($payer->enabled()) {
                $result[] = $payer;
            }
        }

        return $result;
    }
}