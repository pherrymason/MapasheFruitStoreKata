<?php

namespace Mapashe;

class Cart
{
    /** @var ProductCart[] */
    protected $items;

    /** @var Store */
    private $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
        $this->items = [];
    }

    public function addItem($itemName)
    {
        $item = $this->getItem($itemName);
        if ($item === null) {
            $item = new ProductCart($itemName);
            $this->items[] = $item;
        }

        $item->addUnit();
    }

    public function getItem($itemName): ?ProductCart
    {
        foreach ($this->items as $item)
        {
            if ($item->getName() === $itemName) {
                return $item;
            }
        }

        return null;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $price = $this->store->getItemPrice($item);
            $total+= $price;
        }

        return $total;
    }
}
