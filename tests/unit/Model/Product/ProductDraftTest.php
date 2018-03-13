<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

class ProductDraftTest extends \PHPUnit\Framework\TestCase
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
