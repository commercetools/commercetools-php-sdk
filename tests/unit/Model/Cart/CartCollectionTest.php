<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;


class CartCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testIndex()
    {
        $collection = CartCollection::fromArray([
            [
                'id' => '123456'
            ]
        ]);

        $this->assertInstanceOf('\Sphere\Core\Model\Cart\Cart', $collection->getById('123456'));
    }

    public function testAddToIndex()
    {
        $collection = new CartCollection();
        $collection->add(new Cart(['id' => '123456']));

        $this->assertInstanceOf('\Sphere\Core\Model\Cart\Cart', $collection->getById('123456'));
    }
}
