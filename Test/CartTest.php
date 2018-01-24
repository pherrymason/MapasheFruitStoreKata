<?php

namespace Test;

use Mapashe\Cart;
use Mapashe\Store;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    /** @var Cart */
    private $cart;

    public function test_add_products()
    {
        $this->cart->addItem('banana');
        $this->assertEquals(150, $this->cart->getTotal());

        $this->cart->addItem('apple');
        $this->assertEquals(250, $this->cart->getTotal());

        $this->cart->addItem('cherry');
        $this->assertEquals(325, $this->cart->getTotal());
    }

    public function test_add_cherry_discount()
    {
        $this->cart->addItem('apple');
        $this->assertEquals(100, $this->cart->getTotal());

        $this->cart->addItem('cherry');
        $this->assertEquals(175, $this->cart->getTotal());

        $this->cart->addItem('cherry');
        $this->assertEquals(230, $this->cart->getTotal());
    }

    public function test_add_manzana()
    {
        $this->cart->addItem('manzana');
        $this->assertEquals(100, $this->cart->getTotal());
    }

    public function test_add_apfel()
    {
        $this->cart->addItem('apfel');
        $this->assertEquals(100, $this->cart->getTotal());
    }

    public function test_free_banana()
    {
        $this->cart->addItem('banana');
        $this->assertEquals(150, $this->cart->getTotal());

        $this->cart->addItem('banana');
        $this->assertEquals(150, $this->cart->getTotal());
    }

    public function test_discount_3_manzanas()
    {
        $this->cart->addItem('manzana');
        $this->assertEquals(100, $this->cart->getTotal());

        $this->cart->addItem('manzana');
        $this->assertEquals(200, $this->cart->getTotal());

        $this->cart->addItem('manzana');
        $this->assertEquals(200, $this->cart->getTotal());

    }

    public function setUp()
    {
        $this->cart = new Cart(new Store());
    }
}
