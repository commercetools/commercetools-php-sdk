<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\DiscountCodes;

use Commercetools\Core\Model\DiscountCode\DiscountCodeDraft;
use Commercetools\Core\RequestTestCase;

class DiscountCodeCreateRequestTest extends RequestTestCase
{
    const DISCOUNT_CODE_CREATE_REQUEST = '\Commercetools\Core\Request\DiscountCodes\DiscountCodeCreateRequest';

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
        $result = $this->mapResult(DiscountCodeCreateRequest::ofDraft($this->getDraft()));
        $this->assertInstanceOf('\Commercetools\Core\Model\DiscountCode\DiscountCode', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(DiscountCodeCreateRequest::ofDraft($this->getDraft()));
        $this->assertNull($result);
    }
}
