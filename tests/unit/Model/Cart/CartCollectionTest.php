<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

class CartCollectionTest extends \PHPUnit\Framework\TestCase
{
    public function testIndex()
    {
        $collection = CartCollection::fromArray([
            [
                'id' => '123456'
            ]
        ]);

        $this->assertInstanceOf(Cart::class, $collection->getById('123456'));
    }

    public function testAddToIndex()
    {
        $collection = CartCollection::of();
        $collection->add(Cart::fromArray(['id' => '123456']));

        $this->assertInstanceOf(Cart::class, $collection->getById('123456'));
    }
}
