<?php

namespace app\order;

use app\product\AbstractProduct;

/**
 * Class OrderHandler
 */
class Order extends AbstractOrder implements OrderInterface
{
    public function generateNewOrder(): OrderInterface
    {

        $productList = $this->getProductList();

        $numReq = (count($productList) - $this->getTotalProductTypesInList());
        $filteredKeys = array_rand($productList, $numReq);

        if ($numReq < 2) {
            $filteredKeys = [$filteredKeys];
        }

        $filteredKeys = array_flip($filteredKeys);
        $productList = array_diff_key($productList, $filteredKeys);

        $this->setProductList($productList);

        $result = [];

        /**
         * @var $product AbstractProduct
         */
        while ($this->maxValue <= $this->getTotalValue() && count($this->getProductList())) {
            $randKey = $this->getRandomProductKey();
            $productList = $this->getProductList();
            $product = $productList[$randKey];


            if ($product->getCount() < $this->getMaxItemsInProduct()) {
                $product->incrementCount();
                $this->maxValue += $product->getWeight();
            } else {
                unset($productList[$randKey]);
                $this->setProductList($productList);
                continue;
            }

            if ($this->maxValue > $this->getTotalValue()) {
                $this->maxValue -= $product->getWeight();
                continue;
            }

            $productCount = isset($result[get_class($product)]['count']) ? $result[get_class($product)]['count'] + 1 : 1;
            $result[get_class($product)] = [
                'count' => $productCount,
                'weight' => $product->getWeight(),
            ];
        }

        $this->setResultData($result);

        return $this;
    }

    public function shuffleOrder(): OrderInterface
    {
        $resultData = $this->getResultData();
        $relationValues = $this->getProductRelationValues();
        $hasChange = false;

        while (!$hasChange) {
            foreach ($resultData as $randChangeFrom => $resultDatum) {
                foreach ($relationValues[$randChangeFrom] as $key => $value) {

                    if (isset($resultData[$key])) {
                        $countItems = 1 / $value;
                        $existItems = $resultData[$randChangeFrom]['count'];

                        if ($countItems >= 1 && floor($countItems) == $countItems) {
                            if ($countItems < $existItems) {
                                $resultData[$randChangeFrom]['count'] -= $countItems;
                                $resultData[$key]['count'] += 1;
                                $hasChange = true;
                            }
                        }
                    }
                }
            }
        }

        $this->setResultData($resultData);

        return $this;
    }
}
