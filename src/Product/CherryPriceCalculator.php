<?php

namespace Mapashe\Product;

use Mapashe\PriceCalculator;
use Mapashe\Product;
use Mapashe\ProductCart;

class CherryPriceCalculator implements PriceCalculator
{
    public function calculatePrice(Product $product, ProductCart $productCart)
    {
        $quantity = $productCart->getQuantity();
        $total = 0;
        $price = $product->getUnitPrice();

        for ($i=0; $i<$quantity; $i++) {
            $total+= $price;

            if (($i+1) % 2 === 0) {
                $total-= 20;
            }
        }

        return $total;
    }
}
