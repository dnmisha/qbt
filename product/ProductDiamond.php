<?php

namespace app\product;

class ProductDiamond extends AbstractProduct
{
    public function __construct()
    {
        $probability = 5;
        $weight = 1000;

        parent::__construct($probability, $weight);
    }
}
