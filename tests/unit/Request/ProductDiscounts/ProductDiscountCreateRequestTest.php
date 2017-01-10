<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductDiscounts;

use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountDraft;
use Commercetools\Core\RequestTestCase;

class ProductDiscountCreateRequestTest extends RequestTestCase
{
    const PRODUCT_DISCOUNT_CREATE_REQUEST = '\Commercetools\Core\Request\ProductDiscounts\ProductDiscountCreateRequest';

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
        $result = $this->mapResult(ProductDiscountCreateRequest::ofDraft($this->getDraft()));
        $this->assertInstanceOf(ProductDiscount::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductDiscountCreateRequest::ofDraft($this->getDraft()));
        $this->assertNull($result);
    }
}
