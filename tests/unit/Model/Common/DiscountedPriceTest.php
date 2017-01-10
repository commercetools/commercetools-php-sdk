<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\ProductDiscount\ProductDiscountReference;

class DiscountedPriceTest extends \PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $this->assertInstanceOf(
            DiscountedPrice::class,
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
