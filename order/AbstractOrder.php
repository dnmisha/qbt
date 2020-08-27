<?php

namespace app\order;

use app\product\AbstractProduct;

/**
 * Class OrderHandler
 */
class AbstractOrder
{
    /**
     * @var int
     */
    public $totalProductTypesInList = 1;
    /**
     * @var int
     */
    public $totalValue = 65535;
    /**
     * @var int
     */
    public $maxItemsInProduct = 6;
    /**
     * @var int
     */
    public $probabilitySum = 0;
    /**
     * @var int
     */
    public $maxValue = 0;
    /**
     * @var array
     */
    public $productRelationValues = [];
    /**
     * @var array
     */
    private $productList = [];
    /**
     * @var array
     */
    private $resultData = [];

    /**
     * OrderHandler constructor.
     * @param array $productList
     */
    public function __construct(array $productList)
    {
        $this->productList = $productList;

        foreach ($this->productList as $mainProduct) {
            foreach ($this->productList as $relationProduct) {
                if (get_class($mainProduct) !== get_class($relationProduct))
                    $this->productRelationValues[get_class($mainProduct)][get_class($relationProduct)] = $mainProduct->getWeight() / $relationProduct->getWeight();
            }
        }
    }

    /**
     * @return int
     */
    public function getTotalProductTypesInList(): int
    {
        return $this->totalProductTypesInList;
    }

    /**
     * @param int $totalProductTypesInList
     */
    public function setTotalProductTypesInList(int $totalProductTypesInList): void
    {
        $this->totalProductTypesInList = $totalProductTypesInList;
    }

    /**
     * @return int
     */
    public function getTotalValue(): int
    {
        return $this->totalValue;
    }

    /**
     * @param int $totalValue
     */
    public function setTotalValue(int $totalValue): void
    {
        $this->totalValue = $totalValue;
    }

    /**
     * @return int
     */
    public function getMaxItemsInProduct(): int
    {
        return $this->maxItemsInProduct;
    }

    /**
     * @param int $maxItemsInProduct
     */
    public function setMaxItemsInProduct(int $maxItemsInProduct): void
    {
        $this->maxItemsInProduct = $maxItemsInProduct;
    }

    /**
     * @return array
     */
    public function getProductList(): array
    {
        return $this->productList;
    }

    /**
     * @param array $productList
     */
    public function setProductList(array $productList): void
    {
        $this->productList = $productList;
    }

    function getRandomProductKey()
    {
        $this->probabilitySum = 0;

        foreach ($this->productList as $item) {
            $this->probabilitySum += $item->getProbability();
        }
        $randValue = mt_rand(1, $this->probabilitySum);

        /**
         * @var $product AbstractProduct
         */
        $addProp = (100 - $this->probabilitySum) / count($this->productList);

        foreach ($this->productList as $key => $product) {
            $randValue -= $product->getProbability() + $addProp;

            if ($randValue <= 0) {
                return $key;
            }
        }

        return null;
    }

    /**
     * @return array
     */
    public function getResultData(): array
    {
        return $this->resultData;
    }

    /**
     * @param array $resultData
     */
    public function setResultData(array $resultData): void
    {
        $this->resultData = $resultData;
    }

    /**
     * @return array
     */
    public function renderResult(): void
    {
        var_dump($this->resultData);

        $this->maxValue = 0;

        foreach ($this->resultData as $item) {
            $this->maxValue += $item['count'] * $item['weight'];
        }

        var_dump('total value = ' . $this->maxValue);
    }

    /**
     * @return int
     */
    public function getProbabilitySum(): int
    {
        return $this->probabilitySum;
    }

    /**
     * @param int $probabilitySum
     */
    public function setProbabilitySum(int $probabilitySum): void
    {
        $this->probabilitySum = $probabilitySum;
    }

    /**
     * @return array
     */
    public function getProductRelationValues(): array
    {
        return $this->productRelationValues;
    }

    /**
     * @param array $productRelationValues
     */
    public function setProductRelationValues(array $productRelationValues): void
    {
        $this->productRelationValues = $productRelationValues;
    }
}
