<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

class ProductDraftTest extends \PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $this->assertInstanceOf(
            ProductDraft::class,
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
