<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ShippingMethods;


use Sphere\Core\Model\ShippingMethod\ShippingMethodDraft;
use Sphere\Core\RequestTestCase;

class ShippingMethodCreateRequestTest extends RequestTestCase
{
    const SHIPPING_METHOD_CREATE_REQUEST = '\Sphere\Core\Request\ShippingMethods\ShippingMethodCreateRequest';

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
        $result = $this->mapResult(static::SHIPPING_METHOD_CREATE_REQUEST, [$this->getDraft()]);
        $this->assertInstanceOf('\Sphere\Core\Model\ShippingMethod\ShippingMethod', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::SHIPPING_METHOD_CREATE_REQUEST, [$this->getDraft()]);
        $this->assertNull($result);
    }
}
