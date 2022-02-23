<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Inventory;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\Channel\ChannelFixture;
use Commercetools\Core\IntegrationTests\Product\ProductFixture;
use Commercetools\Core\IntegrationTests\Type\TypeFixture;
use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\Inventory\InventoryDraft;
use Commercetools\Core\Model\Inventory\InventoryEntry;
use Commercetools\Core\Model\Message\InventoryEntryDeletedMessage;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\Search\Filter;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Type\TypeDraft;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Request\Inventory\Command\InventoryAddQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventoryChangeQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventoryRemoveQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetExpectedDeliveryAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetRestockableInDaysAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetSupplyChannelAction;
use Commercetools\Core\Request\Messages\MessageQueryRequest;
use Commercetools\Core\Request\Project\Command\ProjectChangeProductSearchIndexingEnabledAction;
use Commercetools\Core\Request\Project\ProjectUpdateRequest;

class InventoryUpdateRequestTest extends ApiTestCase
{
    public function testAddQuantity()
    {
        $client = $this->getApiClient();

        InventoryFixture::withUpdateableDraftInventory(
            $client,
            function (InventoryDraft $draft) {
                return $draft->setQuantityOnStock(0);
            },
            function (InventoryEntry $inventoryEntry) use ($client) {
                $quantity = mt_rand(1, 100);

                $request = RequestBuilder::of()->inventory()->update($inventoryEntry)
                    ->addAction(InventoryAddQuantityAction::ofQuantity($quantity));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(InventoryEntry::class, $result);
                $this->assertSame($quantity, $result->getQuantityOnStock());
                $this->assertNotSame($inventoryEntry->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeQuantity()
    {
        $client = $this->getApiClient();

        InventoryFixture::withUpdateableInventory(
            $client,
            function (InventoryEntry $inventoryEntry) use ($client) {
                $quantity = mt_rand(1, 100);

                $request = RequestBuilder::of()->inventory()->update($inventoryEntry)
                    ->addAction(InventoryChangeQuantityAction::ofQuantity($quantity));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(InventoryEntry::class, $result);
                $this->assertSame($quantity, $result->getQuantityOnStock());
                $this->assertNotSame($inventoryEntry->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testRemoveQuantity()
    {
        $client = $this->getApiClient();

        InventoryFixture::withUpdateableDraftInventory(
            $client,
            function (InventoryDraft $draft) {
                return $draft->setSku('remove-quantity')->setQuantityOnStock(1000);
            },
            function (InventoryEntry $inventoryEntry) use ($client) {
                $quantity = mt_rand(1, 100);

                $request = RequestBuilder::of()->inventory()->update($inventoryEntry)
                    ->addAction(InventoryRemoveQuantityAction::ofQuantity($quantity));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(InventoryEntry::class, $result);
                $this->assertSame(1000 - $quantity, $result->getQuantityOnStock());
                $this->assertNotSame($inventoryEntry->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetExpectedDelivery()
    {
        $client = $this->getApiClient();

        InventoryFixture::withUpdateableInventory(
            $client,
            function (InventoryEntry $inventoryEntry) use ($client) {
                $expectedDelivery = new \DateTime('+ 1 day');

                $request = RequestBuilder::of()->inventory()->update($inventoryEntry)
                    ->addAction(InventorySetExpectedDeliveryAction::of()->setExpectedDelivery($expectedDelivery));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(InventoryEntry::class, $result);
                $expectedDelivery->setTimezone(new \DateTimeZone('UTC'));
                $this->assertEquals(
                    $expectedDelivery->format('c'),
                    $result->getExpectedDelivery()->getDateTime()->format('c')
                );
                $this->assertNotSame($inventoryEntry->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetRestockableInDays()
    {
        $client = $this->getApiClient();

        InventoryFixture::withUpdateableInventory(
            $client,
            function (InventoryEntry $inventoryEntry) use ($client) {
                $restockableInDays = mt_rand(1, 10);

                $request = RequestBuilder::of()->inventory()->update($inventoryEntry)
                    ->addAction(InventorySetRestockableInDaysAction::of()->setRestockableInDays($restockableInDays));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(InventoryEntry::class, $result);
                $this->assertSame($restockableInDays, $result->getRestockableInDays());
                $this->assertNotSame($inventoryEntry->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetSupplyChannel()
    {
        $client = $this->getApiClient();

        ChannelFixture::withChannel(
            $client,
            function (Channel $channel) use ($client) {
                InventoryFixture::withUpdateableInventory(
                    $client,
                    function (InventoryEntry $inventoryEntry) use ($client, $channel) {
                        $request = RequestBuilder::of()->inventory()->update($inventoryEntry)
                            ->addAction(
                                InventorySetSupplyChannelAction::of()->setSupplyChannel($channel->getReference())
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(InventoryEntry::class, $result);
                        $this->assertSame($channel->getId(), $result->getSupplyChannel()->getId());
                        $this->assertNotSame($inventoryEntry->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }

    public function testQueryChannels()
    {
        self::markTestSkipped();
        $client = $this->getApiClient();

        ChannelFixture::withChannel(
            $client,
            function (Channel $channel) use ($client) {
                ProductFixture::withProduct(
                    $client,
                    function (Product $product) use ($client, $channel) {
                        InventoryFixture::withUpdateableDraftInventory(
                            $client,
                            function (InventoryDraft $inventoryDraft) use ($channel) {
                                return $inventoryDraft->setQuantityOnStock(1)
                                    ->setSupplyChannel($channel->getReference());
                            },
                            function (InventoryEntry $inventoryEntry) use ($client, $channel, $product) {
                                $retries = 0;
                                do {
                                    $retries++;
                                    sleep(1);
                                    $request = RequestBuilder::of()->productProjections()->search()
                                        ->addFilterQuery(Filter::ofName('id')->setValue($product->getId()))
                                        ->limit(1);
                                    $response = $this->execute($client, $request);
                                    $result = $request->mapFromResponse($response);
                                } while ($result->count() == 0 && $retries <= 20);

                                if ($result->count() == 0) {
                                    $this->markTestSkipped('Product not updated in time');
                                }

                                $retries = 0;
                                do {
                                    $retries++;
                                    sleep(1);
                                    $request = RequestBuilder::of()->productProjections()->search()
                                        ->addFilterQuery(
                                            Filter::ofName('variants.availability.isOnStockInChannels')
                                                ->setValue([$channel->getId()])
                                        )->limit(1);
                                    $response = $this->execute($client, $request);
                                    $result = $request->mapFromResponse($response);
                                } while ($result->count() == 0 && $retries <= 9);

                                if ($result->count() == 0) {
                                    $this->markTestSkipped('Product channel availability not updated in time');
                                }

                                $this->assertSame(
                                    $product->getId(),
                                    $result->current()->getId()
                                );
                                $this->assertSame(
                                    $channel->getId(),
                                    $result->current()->getMasterVariant()->getAvailability()->getChannels()->key()
                                );

                                return $result;
                            }
                        );
                    }
                );
            }
        );
    }

    /**
     * @large
     */
    public function testInventoryDeleteMessage()
    {
        $client = $this->getApiClient();

        ChannelFixture::withChannel(
            $client,
            function (Channel $channel) use ($client) {
                InventoryFixture::withDraftInventory(
                    $client,
                    function (InventoryDraft $inventoryDraft) use ($channel) {
                        return $inventoryDraft->setSupplyChannel($channel->getReference());
                    },
                    function (InventoryEntry $inventoryEntry) use ($client, $channel) {
                        $request = RequestBuilder::of()->inventory()->delete($inventoryEntry);
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(InventoryEntry::class, $result);

                        $retries = 0;
                        do {
                            $retries++;
                            sleep(1);
                            $request = MessageQueryRequest::of()
                                ->where('type = "InventoryEntryDeleted"')
                                ->where('resource(id = "' . $inventoryEntry->getId() . '")');
                            $response = $this->execute($client, $request);
                            $result = $request->mapFromResponse($response);
                        } while (is_null($result) && $retries <= 9);

                        /**
                         * @var InventoryEntryDeletedMessage $message
                         */
                        $message = $result->current();

                        $this->assertInstanceOf(InventoryEntryDeletedMessage::class, $message);
                        $this->assertSame($inventoryEntry->getId(), $message->getResource()->getId());
                        $this->assertSame($inventoryEntry->getSku(), $message->getSku());
                    }
                );
            }
        );
    }

    public function testSetCustomType()
    {
        $client = $this->getApiClient();

        TypeFixture::withDraftType(
            $client,
            function (TypeDraft $draft) {
                $typeKey = 'type-' . $this->getTestRun();

                return $draft->setKey($typeKey)->setResourceTypeIds(['inventory-entry']);
            },
            function (Type $type) use ($client) {
                InventoryFixture::withUpdateableInventory(
                    $client,
                    function (InventoryEntry $inventoryEntry) use ($client, $type) {
                        $request = RequestBuilder::of()->inventory()->update($inventoryEntry)
                            ->addAction(SetCustomTypeAction::ofTypeKey($type->getKey()));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(InventoryEntry::class, $result);
                        $this->assertSame($type->getId(), $result->getCustom()->getType()->getId());
                        $this->assertNotSame($inventoryEntry->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }

    public function testSetCustomField()
    {
        $client = $this->getApiClient();

        TypeFixture::withDraftType(
            $client,
            function (TypeDraft $draft) {
                $typeKey = 'type-' . $this->getTestRun();

                return $draft->setKey($typeKey)->setResourceTypeIds(['inventory-entry']);
            },
            function (Type $type) use ($client) {
                InventoryFixture::withUpdateableDraftInventory(
                    $client,
                    function (InventoryDraft $draft) use ($type) {
                        $draft->setCustom(CustomFieldObject::of()->setType(TypeReference::ofKey($type->getKey())));

                        return $draft;
                    },
                    function (InventoryEntry $inventoryEntry) use ($client, $type) {
                        $request = RequestBuilder::of()->inventory()->update($inventoryEntry)
                            ->addAction(
                                SetCustomFieldAction::ofName('testField')->setValue((string)$this->getTestRun())
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(InventoryEntry::class, $result);
                        $this->assertSame($type->getId(), $result->getCustom()->getType()->getId());
                        $this->assertSame(
                            (string)$this->getTestRun(),
                            $result->getCustom()->getFields()->getTestField()
                        );
                        $this->assertNotSame($inventoryEntry->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }
}
