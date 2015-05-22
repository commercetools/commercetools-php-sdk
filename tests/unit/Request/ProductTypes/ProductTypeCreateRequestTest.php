<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes;


use Sphere\Core\Model\ProductType\ProductTypeDraft;
use Sphere\Core\RequestTestCase;

class ProductTypeCreateRequestTest extends RequestTestCase
{
    const PRODUCT_TYPE_CREATE_REQUEST = '\Sphere\Core\Request\ProductTypes\ProductTypeCreateRequest';

    protected function getDraft()
    {
        return ProductTypeDraft::fromArray(json_decode(
            '{
                "name": "myProductType",
                "description": "Product Type 1",
                "attributes": [
                    {
                        "type": {
                            "name": "enum",
                            "values": [
                                {
                                    "key": "foo",
                                    "label": "Foo"
                                }
                            ]
                        },
                        "name": "my-enum",
                        "label": {
                            "en": "My Enum"
                        },
                        "isRequired": false,
                        "attributeConstraint": "None",
                        "isSearchable": false
                    }
                ]
            }',
            true
        ));
    }
    public function testMapResult()
    {
        $result = $this->mapResult(static::PRODUCT_TYPE_CREATE_REQUEST, [$this->getDraft()]);
        $this->assertInstanceOf('\Sphere\Core\Model\ProductType\ProductType', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::PRODUCT_TYPE_CREATE_REQUEST, [$this->getDraft()]);
        $this->assertNull($result);
    }
}
