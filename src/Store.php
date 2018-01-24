<?php

declare(strict_types=1);

namespace Mapashe;

use Mapashe\Product\ApplePriceCalculator;
use Mapashe\Product\BananaPriceCalculator;
use Mapashe\Product\CherryPriceCalculator;

class Store
{
    /** @var array */
    protected $wharehouse;

    /** @var array */
    protected $discountChecker;

    /** @var array */
    protected $discountCalculator;

    public function __construct()
    {
        $this->wharehouse = [
            new Product('banana', 150, ['banana'], new BananaPriceCalculator()),
            new Product('apple', 100, ['apple', 'manzana', 'apfel'], new ApplePriceCalculator()),
            new Product('cherry', 75, ['cherry'], new CherryPriceCalculator())
        ];
    }

    public function getItemPrice(ProductCart $productCart)
    {
        $product = null;
        foreach ($this->wharehouse as $productDefinition) {
            if ($productDefinition->isThisProduct($productCart->getName())) {
                $product = $productDefinition;
                break;
            }
        }

        if ($product === null) {
            return null;
        }

        return $product->getTotalPrice($productCart);
    }
}
