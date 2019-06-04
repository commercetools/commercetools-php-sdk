<?php
/**
 */

namespace Commercetools\Core\Request\Stores;

use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\Store\StoreDraft;
use Commercetools\Core\RequestTestCase;

class StoreCreateRequestTest extends RequestTestCase
{
    const STORE_CREATE_REQUEST = StoreCreateRequest::class;

    protected function getDraft()
    {
        return StoreDraft::fromArray(json_decode(
            '{
                "key": "my-store-key",
                "name": {
                    "en" : "my-store-name"
                }
            }',
            true
        ));
    }
    public function testMapResult()
    {
        $result = $this->mapResult(StoreCreateRequest::ofDraft($this->getDraft()));
        $this->assertInstanceOf(Store::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(StoreCreateRequest::ofDraft($this->getDraft()));
        $this->assertNull($result);
    }
}
