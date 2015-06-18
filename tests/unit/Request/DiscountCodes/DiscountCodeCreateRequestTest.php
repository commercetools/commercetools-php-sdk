<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\DiscountCodes;


use Sphere\Core\Model\DiscountCode\DiscountCodeDraft;
use Sphere\Core\RequestTestCase;

class DiscountCodeCreateRequestTest extends RequestTestCase
{
    const DISCOUNT_CODE_CREATE_REQUEST = '\Sphere\Core\Request\DiscountCodes\DiscountCodeCreateRequest';

    protected function getDraft()
    {
        return DiscountCodeDraft::fromArray(json_decode(
            '{
                "name": {
                    "en": "myDiscountCode"
                },
                "description": {
                    "en": "My DiscountCode"
                },
                "code": "discount",
                "cartDiscounts": [
                    {
                        "typeId": "cart-discount",
                        "id": "cartDiscountId"
                    }
                ],
                "cartPredicate": "test",
                "isActive": true,
                "maxApplications": 100,
                "maxApplicationsPerCustomer": 1
            }',
            true
        ));
    }

    public function testMapResult()
    {
        $result = $this->mapResult(static::DISCOUNT_CODE_CREATE_REQUEST, [$this->getDraft()]);
        $this->assertInstanceOf('\Sphere\Core\Model\DiscountCode\DiscountCode', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::DISCOUNT_CODE_CREATE_REQUEST, [$this->getDraft()]);
        $this->assertNull($result);
    }
}
