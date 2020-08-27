<?php

namespace app\product;

class ProductIron extends AbstractProduct
{
    public function __construct()
    {
        $probability = 40;
        $weight = 75;

        parent::__construct($probability, $weight);
    }
}
