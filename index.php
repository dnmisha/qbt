<?php

namespace app;
require "vendor/autoload.php";

use app\order\Order;
use app\product\ProductCopper;
use app\product\ProductDiamond;
use app\product\ProductGold;
use app\product\ProductIron;
use app\product\ProductPlatinum;

$productList = [
    new ProductIron(),
    new ProductCopper(),
    new ProductGold(),
    new ProductPlatinum(),
    new ProductDiamond(),
];

$order = new Order($productList);

$order->setMaxItemsInProduct(6);
$order->setTotalProductTypesInList(4);
$order->setTotalValue(3000);

$order->generateNewOrder();

$order->renderResult();
echo PHP_EOL;

$order->shuffleOrder();

$order->renderResult();
