<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;


class ProductDraftTest extends \PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $this->assertInstanceOf(
            '\Sphere\Core\Model\Product\ProductDraft',
            ProductDraft::fromArray(
                [
                    'productType' => ['typeId' => 'product-type', 'id' => '123456'],
                    'name' => ['en' => 'test'],
                    'slug' => ['en' => 'test'],
                ]
            )
        );
    }
}
