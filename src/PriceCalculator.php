<?php

namespace Mapashe;

interface PriceCalculator
{
    public function calculatePrice(Product $product, ProductCart $productCart);
}
