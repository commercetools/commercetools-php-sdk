<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ProductType;


class ProductTypeDraftTest extends \PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $this->assertInstanceOf(
            '\Sphere\Core\Model\ProductType\ProductTypeDraft',
            ProductTypeDraft::fromArray(
                [
                    'name' => 'test',
                    'description' => 'Test'
                ]
            )
        );
    }
}
