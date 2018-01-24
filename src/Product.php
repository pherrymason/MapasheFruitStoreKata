<?php

namespace Mapashe;

class Product
{
    /** @var string */
    private $name;

    /** @var int */
    private $price;

    /** @var int */
    private $localizations;

    /** @var PriceCalculator */
    private $priceCalculator;

    /**
     * Product constructor.
     */
    public function __construct(string $name, int $price, array $localizations, PriceCalculator $priceCalculator = null)
    {
        $this->name = $name;
        $this->price = $price;
        $this->localizations = $localizations;
        $this->priceCalculator = $priceCalculator;
    }

    public function isThisProduct($localization): bool
    {
        return in_array($localization, $this->localizations);
    }

    public function getUnitPrice(): int
    {
        return $this->price;
    }

    public function getTotalPrice(ProductCart $productCart): int
    {
        if ($this->priceCalculator) {
            return $this->priceCalculator->calculatePrice($this, $productCart);
        }

        return $productCart->getQuantity() * $this->getUnitPrice();
    }
}
