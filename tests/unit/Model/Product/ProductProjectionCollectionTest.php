<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;


class ProductProjectionCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testIndex()
    {
        $collection = ProductProjectionCollection::fromArray([
            [
                'id' => '123456'
            ]
        ]);

        $this->assertInstanceOf('\Sphere\Core\Model\Product\ProductProjection', $collection->getById('123456'));
    }

    public function testAddToIndex()
    {
        $collection = ProductProjectionCollection::of();
        $collection->add(new ProductProjection(['id' => '123456']));

        $this->assertInstanceOf('\Sphere\Core\Model\Product\ProductProjection', $collection->getById('123456'));
    }
}
