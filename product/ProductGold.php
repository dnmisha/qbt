<?php

namespace app\product;

class ProductGold extends AbstractProduct
{
    public function __construct()
    {
        $probability = 15;
        $weight = 150;

        parent::__construct($probability, $weight);
    }
}
