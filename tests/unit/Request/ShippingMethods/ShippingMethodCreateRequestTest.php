<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods;

use Commercetools\Core\Model\ShippingMethod\ShippingMethodDraft;
use Commercetools\Core\RequestTestCase;

class ShippingMethodCreateRequestTest extends RequestTestCase
{
    const SHIPPING_METHOD_CREATE_REQUEST = '\Commercetools\Core\Request\ShippingMethods\ShippingMethodCreateRequest';

    protected function getDraft()
    {
        return ShippingMethodDraft::fromArray(json_decode(
            '{
                "name": "myShippingMethod",
                "description": "Shipping Method 1",
                "taxCategory": {
                    "typeId": "tax-category",
                    "id": "tax-category-id"
                },
                "zoneRates": [
                    {
                        "zone": {
                            "typeId": "zone",
                            "id": "zone-id"
                        },
                        "shippingRates": [
                            {
                                "price": {
                                    "currencyCode": "EUR",
                                    "centAmount": 100
                                },
                                "freeAbove": {
                                    "currencyCode": "EUR",
                                    "centAmount": 200
                                }
                            }
                        ]
                    }
                ],
                "isDefault": true
            }',
            true
        ));
    }
    public function testMapResult()
    {
        $result = $this->mapResult(ShippingMethodCreateRequest::ofDraft($this->getDraft()));
        $this->assertInstanceOf('\Commercetools\Core\Model\ShippingMethod\ShippingMethod', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ShippingMethodCreateRequest::ofDraft($this->getDraft()));
        $this->assertNull($result);
    }
}
