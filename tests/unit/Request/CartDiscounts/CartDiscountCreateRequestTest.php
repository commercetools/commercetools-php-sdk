<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts;


use Sphere\Core\Model\CartDiscount\CartDiscountDraft;
use Sphere\Core\RequestTestCase;

class CartDiscountCreateRequestTest extends RequestTestCase
{
    const CART_DISCOUNT_CREATE_REQUEST = '\Sphere\Core\Request\CartDiscounts\CartDiscountCreateRequest';

    protected function getDraft()
    {
        return CartDiscountDraft::fromArray(json_decode(
            '{
                "name": {
                    "en": "myCartDiscount"
                },
                "description": {
                    "en": "CartDiscount 1"
                },
                "value": {
                    "type": "absolute",
                    "money": [
                        {
                            "currencyCode": "EUR",
                            "centAmount": 100
                        }
                    ]
                },
                "cartPredicate": "test",
                "target": {
                    "type": "lineItems",
                    "predicate": "test"
                },
                "sortOrder": "0.2",
                "isActive": true,
                "validFrom": "2015-05-15T12:00:00+00:00",
                "validUntil": "2015-05-16T12:00:00+00:00",
                "requiresDiscountCode": false
            }',
            true
        ));
    }

    public function testMapResult()
    {
        $result = $this->mapResult(CartDiscountCreateRequest::ofDraft($this->getDraft()));
        $this->assertInstanceOf('\Sphere\Core\Model\CartDiscount\CartDiscount', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(CartDiscountCreateRequest::ofDraft($this->getDraft()));
        $this->assertNull($result);
    }
}
