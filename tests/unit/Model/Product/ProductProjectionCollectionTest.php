<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

class ProductProjectionCollectionTest extends \PHPUnit\Framework\TestCase
{
    public function testIndex()
    {
        $collection = ProductProjectionCollection::fromArray([
            [
                'id' => '123456'
            ]
        ]);

        $this->assertInstanceOf(ProductProjection::class, $collection->getById('123456'));
    }

    public function testAddToIndex()
    {
        $collection = ProductProjectionCollection::of();
        $collection->add(new ProductProjection(['id' => '123456']));

        $this->assertInstanceOf(ProductProjection::class, $collection->getById('123456'));
    }
}
