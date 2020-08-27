<?php

namespace app\product;

class ProductPlatinum extends AbstractProduct
{
    public function __construct()
    {
        $probability = 10;
        $weight = 500;

        parent::__construct($probability, $weight);
    }
}
