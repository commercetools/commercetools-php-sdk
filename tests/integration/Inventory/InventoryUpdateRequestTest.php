<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Inventory;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\Inventory\InventoryDraft;
use Commercetools\Core\Model\Message\InventoryEntryDeletedMessage;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Request\Inventory\Command\InventoryAddQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventoryChangeQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventoryRemoveQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetExpectedDeliveryAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetRestockableInDaysAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetSupplyChannelAction;
use Commercetools\Core\Request\Inventory\InventoryCreateRequest;
use Commercetools\Core\Request\Inventory\InventoryDeleteRequest;
use Commercetools\Core\Request\Inventory\InventoryUpdateRequest;
use Commercetools\Core\Request\Messages\MessageQueryRequest;

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

        $this->cleanupRequests[] = $this->deleteRequest = InventoryDeleteRequest::ofIdAndVersion(
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

        $this->deleteRequest->setVersion($result->getVersion());
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

        $this->deleteRequest->setVersion($result->getVersion());
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

        $this->deleteRequest->setVersion($result->getVersion());
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

        $this->deleteRequest->setVersion($result->getVersion());
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

        $this->deleteRequest->setVersion($result->getVersion());
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

        $this->deleteRequest->setVersion($result->getVersion());
    }

    /**
     * @medium
     */
    public function testInventoryDeleteMessage()
    {
        $channel = $this->getChannel();
        $draft = $this->getDraft('delete-message');
        $draft->setSupplyChannel($channel->getReference());
        $inventory = $this->createInventory($draft);

        $request = InventoryDeleteRequest::ofIdAndVersion($inventory->getId(), $inventory->getVersion());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Inventory\InventoryEntry', $result);
        array_pop($this->cleanupRequests);

        sleep(1);
        $request = MessageQueryRequest::of()
            ->where('type = "InventoryEntryDeleted"')
            ->where('resource(id = "' . $inventory->getId() . '")');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        /**
         * @var InventoryEntryDeletedMessage $message
         */
        $message = $result->current();
        $this->assertInstanceOf('\Commercetools\Core\Model\Message\InventoryEntryDeletedMessage', $message);
        $this->assertSame($inventory->getId(), $message->getResource()->getId());
        $this->assertSame($inventory->getSku(), $message->getSku());
    }

    public function testSetCustomType()
    {
        $draft = $this->getDraft('set-custom-type');
        $inventory = $this->createInventory($draft);

        $typeKey = 'type-' . $this->getTestRun();
        $type = $this->getType($typeKey, 'inventory-entry');

        $request = InventoryUpdateRequest::ofIdAndVersion($inventory->getId(), $inventory->getVersion())
            ->addAction(
                SetCustomTypeAction::ofTypeKey($typeKey)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Inventory\InventoryEntry', $result);
        $this->assertSame($type->getId(), $result->getCustom()->getType()->getId());
        $this->assertNotSame($inventory->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testSetCustomField()
    {
        $typeKey = 'type-' . $this->getTestRun();
        $type = $this->getType($typeKey, 'inventory-entry');

        $draft = $this->getDraft('set-custom-type');
        $draft->setCustom(CustomFieldObject::of()->setType(TypeReference::ofKey($typeKey)));
        $inventory = $this->createInventory($draft);

        $request = InventoryUpdateRequest::ofIdAndVersion($inventory->getId(), $inventory->getVersion())
            ->addAction(
                SetCustomFieldAction::ofName('testField')->setValue((string)$this->getTestRun())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Inventory\InventoryEntry', $result);
        $this->assertSame($type->getId(), $result->getCustom()->getType()->getId());
        $this->assertSame((string)$this->getTestRun(), $result->getCustom()->getFields()->getTestField());
        $this->assertNotSame($inventory->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());
    }
}
