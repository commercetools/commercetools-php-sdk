<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes;


use Commercetools\Core\Model\ProductType\ProductTypeDraft;
use Commercetools\Core\RequestTestCase;

class ProductTypeCreateRequestTest extends RequestTestCase
{
    const PRODUCT_TYPE_CREATE_REQUEST = '\Commercetools\Core\Request\ProductTypes\ProductTypeCreateRequest';

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
        $result = $this->mapResult(ProductTypeCreateRequest::ofDraft($this->getDraft()));
        $this->assertInstanceOf('\Commercetools\Core\Model\ProductType\ProductType', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductTypeCreateRequest::ofDraft($this->getDraft()));
        $this->assertNull($result);
    }
}
