<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

class ProductTypeDraftTest extends \PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $this->assertInstanceOf(
            '\Commercetools\Core\Model\ProductType\ProductTypeDraft',
            ProductTypeDraft::fromArray(
                [
                    'name' => 'test',
                    'description' => 'Test'
                ]
            )
        );
    }
}
