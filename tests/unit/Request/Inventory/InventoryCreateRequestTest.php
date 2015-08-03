<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Inventory;


use Commercetools\Core\Model\Inventory\InventoryDraft;
use Commercetools\Core\RequestTestCase;

class InventoryCreateRequestTest extends RequestTestCase
{
    const INVENTORY_CREATE_REQUEST = '\Commercetools\Core\Request\Inventory\InventoryCreateRequest';

    protected function getDraft()
    {
        return InventoryDraft::fromArray(json_decode(
            '{
                "sku": "SKU-12345",
                "quantityOnStock": 100,
                "restockableInDays": 5,
                "expectedDelivery": "2015-05-15T12:00:00+00:00",
                "supplyChannel": {
                    "typeId": "channel",
                    "id": "supply-channel-id"
                }
            }',
            true
        ));
    }
    public function testMapResult()
    {
        $result = $this->mapResult(InventoryCreateRequest::ofDraft($this->getDraft()));
        $this->assertInstanceOf('\Commercetools\Core\Model\Inventory\InventoryEntry', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(InventoryCreateRequest::ofDraft($this->getDraft()));
        $this->assertNull($result);
    }
}
