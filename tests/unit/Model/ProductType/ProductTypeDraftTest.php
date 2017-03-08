<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

class ProductTypeDraftTest extends \PHPUnit\Framework\TestCase
{
    public function testFromArray()
    {
        $this->assertInstanceOf(
            ProductTypeDraft::class,
            ProductTypeDraft::fromArray(
                [
                    'name' => 'test',
                    'description' => 'Test'
                ]
            )
        );
    }
}
