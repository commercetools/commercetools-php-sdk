<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


use Sphere\Core\Model\ProductDiscount\ProductDiscountReference;

class DiscountedPriceTest extends \PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $this->assertInstanceOf(
            '\Sphere\Core\Model\Common\DiscountedPrice',
            DiscountedPrice::fromArray([
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 100
                ],
                'discount' => [
                    'typeId' => 'product-discount',
                    'id' => '123456'
                ]
            ])
        );
    }
}
