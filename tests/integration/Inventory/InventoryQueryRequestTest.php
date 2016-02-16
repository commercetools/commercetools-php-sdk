<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Inventory;


use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Inventory\InventoryDraft;
use Commercetools\Core\Request\Inventory\InventoryByIdGetRequest;
use Commercetools\Core\Request\Inventory\InventoryCreateRequest;
use Commercetools\Core\Request\Inventory\InventoryDeleteRequest;
use Commercetools\Core\Request\Inventory\InventoryQueryRequest;

class InventoryQueryRequestTest extends ApiTestCase
{
    /**
     * @return InventoryDraft
     */
    protected function getDraft()
    {
        $draft = InventoryDraft::ofSkuAndQuantityOnStock(
            'test-' . $this->getTestRun() . '-sku',
            1
        );

        return $draft;
    }

    protected function createInventory(InventoryDraft $draft)
    {
        $request = InventoryCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $inventory = $request->mapResponse($response);

        $this->cleanupRequests[] = InventoryDeleteRequest::ofIdAndVersion(
            $inventory->getId(),
            $inventory->getVersion()
        );

        return $inventory;
    }

    public function testQueryByName()
    {
        $draft = $this->getDraft();
        $inventory = $this->createInventory($draft);

        $result = $this->getClient()->execute(
            InventoryQueryRequest::of()->where('sku="' . $draft->getSku() . '"')
        )->toObject();

        $this->assertCount(1, $result);
        $this->assertInstanceOf('\Commercetools\Core\Model\Inventory\InventoryEntry', $result->getAt(0));
        $this->assertSame($inventory->getId(), $result->getAt(0)->getId());
    }

    public function testQueryById()
    {
        $draft = $this->getDraft();
        $inventory = $this->createInventory($draft);

        $result = $this->getClient()->execute(InventoryByIdGetRequest::ofId($inventory->getId()))->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Inventory\InventoryEntry', $inventory);
        $this->assertSame($inventory->getId(), $result->getId());

    }
}
