<?php

namespace Mapashe\Product;

use Mapashe\PriceCalculator;
use Mapashe\Product;
use Mapashe\ProductCart;

class ApplePriceCalculator implements PriceCalculator
{
    public function calculatePrice(Product $product, ProductCart $productCart)
    {
        $localization = $productCart->getName();
        $quantity = $productCart->getQuantity();
        $price = $product->getUnitPrice();
        $total = 0;

        for ($i=0; $i<$quantity; $i++) {
            $total+= $price;

            $total+= $this->getDiscount($localization, $i+1);
        }

        return $total;
    }

    private function getDiscount($localization, $i)
    {
        if ($localization === 'manzana' && $i !== 0 && $i%3 === 0) {
            return -100;
        }

        if ($localization === 'apfel' && $i !== 0 && $i%2 === 0) {
            return -50;
        }

        if ($localization === 'apple' && $i%4===0) {
            return -100;
        }

        return 0;
    }
}
