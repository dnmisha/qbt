<?php

namespace app\product;

/**
 * Class AbstractProduct
 */
abstract class AbstractProduct
{
    /**
     * @var null|int
     */
    private $type = null;
    /**
     * @var int
     */
    private $count = 0;
    /**
     * @var int
     */
    private $probability = 0;
    /**
     * @var int
     */
    private $weight = 0;

    /**
     * AbstractProduct constructor.
     * @param int $probability
     * @param int $weight
     */
    public function __construct(int $probability, int $weight)
    {
        $this->probability = $probability;
        $this->weight = $weight;
    }

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int|null $type
     */
    public function setType(?int $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    /**
     * @return int
     */
    public function getProbability(): int
    {
        return $this->probability;
    }

    /**
     * @param int $probability
     */
    public function setProbability(int $probability): void
    {
        $this->probability = $probability;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    public function decrementCount()
    {
        $this->count--;
    }

    public function incrementCount()
    {
        $this->count++;
    }
}
