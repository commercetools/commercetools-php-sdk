<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Inventory;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Inventory\InventoryDraft;
use Commercetools\Core\Request\Inventory\Command\InventoryAddQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventoryChangeQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventoryRemoveQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetExpectedDeliveryAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetRestockableInDaysAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetSupplyChannelAction;
use Commercetools\Core\Request\Inventory\InventoryCreateRequest;
use Commercetools\Core\Request\Inventory\InventoryDeleteRequest;
use Commercetools\Core\Request\Inventory\InventoryUpdateRequest;

class InventoryUpdateRequestTest extends ApiTestCase
{
    /**
     * @param $sku
     * @param int $quantity
     * @return InventoryDraft
     */
    protected function getDraft($sku, $quantity = 0)
    {
        $draft = InventoryDraft::ofSkuAndQuantityOnStock(
            'test-' . $this->getTestRun() . '-' . $sku,
            $quantity
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

    public function testAddQuantity()
    {
        $draft = $this->getDraft('add-quantity');
        $inventory = $this->createInventory($draft);

        $quantity = mt_rand(1, 100);
        $request = InventoryUpdateRequest::ofIdAndVersion($inventory->getId(), $inventory->getVersion())
            ->addAction(
                InventoryAddQuantityAction::ofQuantity($quantity)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Inventory\InventoryEntry', $result);
        $this->assertSame($quantity, $result->getQuantityOnStock());
        $this->assertNotSame($inventory->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Inventory\InventoryEntry', $result);
    }

    public function testChangeQuantity()
    {
        $draft = $this->getDraft('change-quantity');
        $inventory = $this->createInventory($draft);

        $quantity = mt_rand(1, 100);
        $request = InventoryUpdateRequest::ofIdAndVersion($inventory->getId(), $inventory->getVersion())
            ->addAction(
                InventoryChangeQuantityAction::ofQuantity($quantity)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Inventory\InventoryEntry', $result);
        $this->assertSame($quantity, $result->getQuantityOnStock());
        $this->assertNotSame($inventory->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Inventory\InventoryEntry', $result);
    }

    public function testRemoveQuantity()
    {
        $draft = $this->getDraft('remove-quantity', 1000);
        $inventory = $this->createInventory($draft);

        $quantity = mt_rand(1, 100);
        $request = InventoryUpdateRequest::ofIdAndVersion($inventory->getId(), $inventory->getVersion())
            ->addAction(
                InventoryRemoveQuantityAction::ofQuantity($quantity)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Inventory\InventoryEntry', $result);
        $this->assertSame(1000 - $quantity, $result->getQuantityOnStock());
        $this->assertNotSame($inventory->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Inventory\InventoryEntry', $result);
    }

    public function testSetExpectedDelivery()
    {
        $draft = $this->getDraft('expected-delivery');
        $inventory = $this->createInventory($draft);

        $expectedDelivery = new \DateTime('+ 1 day');
        $request = InventoryUpdateRequest::ofIdAndVersion($inventory->getId(), $inventory->getVersion())
            ->addAction(
                InventorySetExpectedDeliveryAction::of()->setExpectedDelivery($expectedDelivery)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Inventory\InventoryEntry', $result);
        $this->assertEquals($expectedDelivery, $result->getExpectedDelivery()->getDateTime());
        $this->assertNotSame($inventory->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Inventory\InventoryEntry', $result);
    }

    public function testSetRestockableInDays()
    {
        $draft = $this->getDraft('restockable-in-days');
        $inventory = $this->createInventory($draft);

        $restockableInDays = mt_rand(1, 10);
        $request = InventoryUpdateRequest::ofIdAndVersion($inventory->getId(), $inventory->getVersion())
            ->addAction(
                InventorySetRestockableInDaysAction::of()->setRestockableInDays($restockableInDays)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Inventory\InventoryEntry', $result);
        $this->assertSame($restockableInDays, $result->getRestockableInDays());
        $this->assertNotSame($inventory->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Inventory\InventoryEntry', $result);
    }

    public function testSetSupplyChannel()
    {
        $draft = $this->getDraft('set-supply-channel');
        $inventory = $this->createInventory($draft);

        $channel = $this->getChannel();
        $request = InventoryUpdateRequest::ofIdAndVersion($inventory->getId(), $inventory->getVersion())
            ->addAction(
                InventorySetSupplyChannelAction::of()->setSupplyChannel($channel->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Inventory\InventoryEntry', $result);
        $this->assertSame($channel->getId(), $result->getSupplyChannel()->getId());
        $this->assertNotSame($inventory->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Inventory\InventoryEntry', $result);
    }
}
