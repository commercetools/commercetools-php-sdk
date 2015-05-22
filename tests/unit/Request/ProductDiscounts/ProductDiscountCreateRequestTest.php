<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductDiscounts;


use Sphere\Core\Model\ProductDiscount\ProductDiscountDraft;
use Sphere\Core\RequestTestCase;

class ProductDiscountCreateRequestTest extends RequestTestCase
{
    const PRODUCT_DISCOUNT_CREATE_REQUEST = '\Sphere\Core\Request\ProductDiscounts\ProductDiscountCreateRequest';

    protected function getDraft()
    {
        return ProductDiscountDraft::fromArray(json_decode(
            '{
                "name": {
                    "en": "myProductDiscount"
                },
                "description": {
                    "en": "My Product Discount"
                },
                "value": {
                    "type": "relative",
                    "permyriad": 1000
                },
                "predicate": "test",
                "sortOrder": "sort",
                "isActive": true
            }',
            true
        ));
    }
    public function testMapResult()
    {
        $result = $this->mapResult(static::PRODUCT_DISCOUNT_CREATE_REQUEST, [$this->getDraft()]);
        $this->assertInstanceOf('\Sphere\Core\Model\ProductDiscount\ProductDiscount', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::PRODUCT_DISCOUNT_CREATE_REQUEST, [$this->getDraft()]);
        $this->assertNull($result);
    }
}
