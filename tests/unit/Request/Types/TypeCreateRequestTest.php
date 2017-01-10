<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types;

use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Type\TypeDraft;
use Commercetools\Core\RequestTestCase;

class TypeCreateRequestTest extends RequestTestCase
{
    const TYPE_CREATE_REQUEST = TypeCreateRequest::class;

    protected function getDraft()
    {
        return TypeDraft::fromArray(json_decode(
            '{
                "key": "myType",
                "name": {
                    "en": "My Type"
                },
                "description": {
                    "en": "My Type description"
                },
                "resourceTypeIds": ["category"],
                "fieldDefinitions": [
                    {
                        "type": {
                            "name": "String"
                        },
                        "name": "custom-string",
                        "label": {
                            "en": "Custom String"
                        },
                        "required": false,
                        "inputHint": "SingleLine"
                    }
                ]
            }',
            true
        ));
    }
    public function testMapResult()
    {
        $result = $this->mapResult(TypeCreateRequest::ofDraft($this->getDraft()));
        $this->assertInstanceOf(Type::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(TypeCreateRequest::ofDraft($this->getDraft()));
        $this->assertNull($result);
    }
}
