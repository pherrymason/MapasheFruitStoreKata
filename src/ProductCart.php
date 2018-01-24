<?php

namespace Mapashe;

class ProductCart
{
    /** @var string */
    private $localization;

    /** @var int */
    private $quantity;

    public function __construct(string $localization)
    {
        $this->localization = $localization;
        $this->quantity = 0;
    }

    public function addUnit()
    {
        $this->quantity++;
    }

    public function getName(): string
    {
        return $this->localization;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
