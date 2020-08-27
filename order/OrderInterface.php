<?php

namespace app\order;

interface OrderInterface
{
    public function generateNewOrder(): self;

    public function shuffleOrder(): self;
}
