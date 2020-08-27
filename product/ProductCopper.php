<?php

namespace app\product;

class ProductCopper extends AbstractProduct
{
    public function __construct()
    {
        $probability = 30;
        $weight = 75;

        parent::__construct($probability, $weight);
    }
}
