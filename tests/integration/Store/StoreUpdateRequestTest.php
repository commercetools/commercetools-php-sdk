<?php

namespace Commercetools\Core\IntegrationTests\Store;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\Channel\ChannelFixture;
use Commercetools\Core\IntegrationTests\ProductSelection\ProductSelectionFixture;
use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Model\Channel\ChannelDraft;
use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Channel\ChannelRole;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\ProductSelection\ProductSelection;
use Commercetools\Core\Model\ProductSelection\ProductSelectionDraft;
use Commercetools\Core\Model\ProductSelection\ProductSelectionReference;
use Commercetools\Core\Model\ProductSelection\ProductSelectionType;
use Commercetools\Core\Model\Store\ProductSelectionSettingDraft;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\Store\StoreDraft;
use Commercetools\Core\Request\Stores\Command\StoreAddDistributionChannelAction;
use Commercetools\Core\Request\Stores\Command\StoreAddProductSelectionAction;
use Commercetools\Core\Request\Stores\Command\StoreAddSupplyChannelAction;
use Commercetools\Core\Request\Stores\Command\StoreRemoveDistributionChannelAction;
use Commercetools\Core\Request\Stores\Command\StoreRemoveProductSelectionAction;
use Commercetools\Core\Request\Stores\Command\StoreRemoveSupplyChannelAction;
use Commercetools\Core\Request\Stores\Command\StoreSetDistributionChannelsAction;
use Commercetools\Core\Request\Stores\Command\StoreSetLanguagesAction;
use Commercetools\Core\Request\Stores\Command\StoreSetNameAction;
use Commercetools\Core\Request\Stores\Command\StoreSetProductSelectionsAction;
use Commercetools\Core\Request\Stores\Command\StoreSetSupplyChannelsAction;
use Nette\Utils\ArrayList;

class StoreUpdateRequestTest extends ApiTestCase
{
    public function testUpdateName()
    {
        $client = $this->getApiClient();

        StoreFixture::withUpdateableStore(
            $client,
            function (Store $store) use ($client) {
                $name = 'new-name' . StoreFixture::uniqueStoreString();

                $request = RequestBuilder::of()->stores()->update($store)
                    ->addAction(StoreSetNameAction::ofName(LocalizedString::ofLangAndText('en', $name)));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Store::class, $result);
                $this->assertSame($store->getId(), $result->getId());
                $this->assertSame($name, $result->getName()->en);
                $this->assertNotSame($store->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testUpdateByKey()
    {
        $client = $this->getApiClient();

        StoreFixture::withUpdateableStore(
            $client,
            function (Store $store) use ($client) {
                $name = 'new-name' . StoreFixture::uniqueStoreString();

                $request = RequestBuilder::of()->stores()->updateByKey($store)
                    ->addAction(StoreSetNameAction::ofName(LocalizedString::ofLangAndText('en', $name)));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Store::class, $result);
                $this->assertSame($store->getId(), $result->getId());
                $this->assertSame($name, $result->getName()->en);
                $this->assertNotSame($store->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testUpdateLanguages()
    {
        $client = $this->getApiClient();

        StoreFixture::withUpdateableStore(
            $client,
            function (Store $store) use ($client) {
                $language = 'en';

                $request = RequestBuilder::of()->stores()->update($store)
                    ->addAction(StoreSetLanguagesAction::ofLanguages([$language]));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Store::class, $result);
                $this->assertSame($store->getId(), $result->getId());
                $this->assertSame($language, current($result->getLanguages()));
                $this->assertNotSame($store->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testUpdateByKeyLanguages()
    {
        $client = $this->getApiClient();

        StoreFixture::withUpdateableStore(
            $client,
            function (Store $store) use ($client) {
                $language = 'en';

                $request = RequestBuilder::of()->stores()->updateByKey($store)
                    ->addAction(StoreSetLanguagesAction::ofLanguages([$language]));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Store::class, $result);
                $this->assertSame($store->getKey(), $result->getKey());
                $this->assertSame($language, current($result->getLanguages()));
                $this->assertNotSame($store->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetDistributionChannels()
    {
        $client = $this->getApiClient();

        ChannelFixture::withDraftChannel(
            $client,
            function (ChannelDraft $draft) {
                return $draft->setRoles([ChannelRole::PRODUCT_DISTRIBUTION]);
            },
            function (Channel $channel) use ($client) {
                StoreFixture::withUpdateableStore(
                    $client,
                    function (Store $store) use ($client, $channel) {
                        $channelReference = ChannelReference::ofId($channel->getId());
                        $channels = [0 => $channelReference];

                        $request = RequestBuilder::of()->stores()->update($store)
                            ->addAction(StoreSetDistributionChannelsAction::ofDistributionChannels($channels));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Store::class, $result);
                        $this->assertSame($store->getId(), $result->getId());
                        $this->assertSame($channelReference->getId(), current($result)['distributionChannels'][0]['id']);
                        $this->assertNotSame($store->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }

    public function testAddDistributionChannel()
    {
        $client = $this->getApiClient();

        ChannelFixture::withDraftChannel(
            $client,
            function (ChannelDraft $draft) {
                return $draft->setRoles([ChannelRole::PRODUCT_DISTRIBUTION]);
            },
            function (Channel $channel) use ($client) {
                StoreFixture::withUpdateableStore(
                    $client,
                    function (Store $store) use ($client, $channel) {
                        $channelReference = ChannelReference::ofId($channel->getId());

                        $request = RequestBuilder::of()->stores()->update($store)
                            ->addAction(StoreAddDistributionChannelAction::ofDistributionChannel($channelReference));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Store::class, $result);
                        $this->assertSame($store->getId(), $result->getId());
                        $this->assertSame($channelReference->getId(), current($result)['distributionChannels'][0]['id']);
                        $this->assertNotSame($store->getVersion(), $result->getVersion());


                        return $result;
                    }
                );
            }
        );
    }

    public function testRemoveDistributionChannel()
    {
        $client = $this->getApiClient();

        ChannelFixture::withDraftChannel(
            $client,
            function (ChannelDraft $draft) {
                return $draft->setRoles([ChannelRole::PRODUCT_DISTRIBUTION]);
            },
            function (Channel $channel) use ($client) {
                $channelReference = ChannelReference::ofId($channel->getId());
                $channels = [0 => $channelReference];

                StoreFixture::withUpdateableDraftStore(
                    $client,
                    function (StoreDraft $storeDraft) use ($channels) {
                        $storeDraft->setKey("removeChannelStore")
                              ->setName(LocalizedString::ofLangAndText('en', "removeChannelStore"))
                              ->setDistributionChannels($channels);

                        return $storeDraft;
                    },
                    function (Store $store) use ($client, $channelReference) {
                        $request = RequestBuilder::of()->stores()->update($store)
                            ->addAction(StoreRemoveDistributionChannelAction::ofDistributionChannel($channelReference));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Store::class, $result);
                        $this->assertSame($store->getId(), $result->getId());
                        $this->assertNotSame($store->getVersion(), $result->getVersion());
                        $this->assertEmpty($result->getDistributionChannels());

                        return $result;
                    }
                );
            }
        );
    }

    public function testSetSupplyChannels()
    {
        $client = $this->getApiClient();

        ChannelFixture::withDraftChannel(
            $client,
            function (ChannelDraft $draft) {
                return $draft->setRoles([ChannelRole::INVENTORY_SUPPLY]);
            },
            function (Channel $channel) use ($client) {
                StoreFixture::withUpdateableStore(
                    $client,
                    function (Store $store) use ($client, $channel) {
                        $channelReference = ChannelReference::ofId($channel->getId());
                        $channels = [0 => $channelReference];

                        $request = RequestBuilder::of()->stores()->update($store)
                            ->addAction(StoreSetSupplyChannelsAction::ofSupplyChannels($channels));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Store::class, $result);
                        $this->assertSame($store->getId(), $result->getId());
                        $this->assertSame($channelReference->getId(), current($result)['supplyChannels'][0]['id']);
                        $this->assertNotSame($store->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }

    public function testAddSupplyChannel()
    {
        $client = $this->getApiClient();

        ChannelFixture::withDraftChannel(
            $client,
            function (ChannelDraft $draft) {
                return $draft->setRoles([ChannelRole::INVENTORY_SUPPLY]);
            },
            function (Channel $channel) use ($client) {
                StoreFixture::withUpdateableStore(
                    $client,
                    function (Store $store) use ($client, $channel) {
                        $channelReference = ChannelReference::ofId($channel->getId());

                        $request = RequestBuilder::of()->stores()->update($store)
                            ->addAction(StoreAddSupplyChannelAction::ofSupplyChannel($channelReference));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Store::class, $result);
                        $this->assertSame($store->getId(), $result->getId());
                        $this->assertSame($channelReference->getId(), current($result)['supplyChannels'][0]['id']);
                        $this->assertNotSame($store->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }

    public function testRemoveSupplyChannel()
    {
        $client = $this->getApiClient();

        ChannelFixture::withDraftChannel(
            $client,
            function (ChannelDraft $draft) {
                return $draft->setRoles([ChannelRole::INVENTORY_SUPPLY]);
            },
            function (Channel $channel) use ($client) {
                $channelReference = ChannelReference::ofId($channel->getId());
                $channels = [0 => $channelReference];

                StoreFixture::withUpdateableDraftStore(
                    $client,
                    function (StoreDraft $storeDraft) use ($channels) {
                        $storeDraft->setKey("removeChannelStore")
                            ->setName(LocalizedString::ofLangAndText('en', "removeChannelStore"))
                            ->setSupplyChannels($channels);

                        return $storeDraft;
                    },
                    function (Store $store) use ($client, $channelReference) {
                        $request = RequestBuilder::of()->stores()->update($store)
                            ->addAction(StoreRemoveSupplyChannelAction::ofSupplyChannel($channelReference));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Store::class, $result);
                        $this->assertSame($store->getId(), $result->getId());
                        $this->assertNotSame($store->getVersion(), $result->getVersion());
                        $this->assertEmpty($result->getSupplyChannels());

                        return $result;
                    }
                );
            }
        );
    }

    public function testSetProductSelections()
    {
        $client = $this->getApiClient();

        ProductSelectionFixture::withProductSelection(
            $client,
            function (ProductSelection $productSelection) use ($client) {
                StoreFixture::withUpdateableStore(
                    $client,
                    function (Store $store) use ($client, $productSelection) {
                        $productSelectionReference = ProductSelectionReference::ofId($productSelection->getId());
                        $productSelectionSettingDraft = ProductSelectionSettingDraft::of()->setProductSelection($productSelectionReference);
                        $productSelection = [0 => $productSelectionSettingDraft];

                        $request = RequestBuilder::of()->stores()->update($store)
                            ->addAction(StoreSetProductSelectionsAction::ofProductSelections($productSelection));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Store::class, $result);
                        $this->assertSame($store->getId(), $result->getId());
                        $this->assertSame($productSelectionReference->getId(), current($result)['productSelections'][0]['productSelection']['id']);
                        $this->assertNotSame($store->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }

    public function testAddProductSelection()
    {
        $client = $this->getApiClient();

        ProductSelectionFixture::withProductSelection(
            $client,
            function (ProductSelection $productSelection) use ($client) {
                StoreFixture::withUpdateableStore(
                    $client,
                    function (Store $store) use ($client, $productSelection) {
                        $productSelectionReference = ProductSelectionReference::ofId($productSelection->getId());
                        $productSelectionSettingDraft = ProductSelectionSettingDraft::of()->setProductSelection($productSelectionReference)->setActive(true);

                        $request = RequestBuilder::of()->stores()->update($store)
                            ->addAction(StoreAddProductSelectionAction::ofProductSelection($productSelectionSettingDraft));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Store::class, $result);
                        $this->assertSame($store->getId(), $result->getId());
                        $this->assertSame($productSelectionReference->getId(), current($result)['productSelections'][0]['productSelection']['id']);
                        $this->assertNotSame($store->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }

    public function testRemoveProductSelection()
    {
        $client = $this->getApiClient();

        ProductSelectionFixture::withProductSelection(
            $client,
            function (ProductSelection $productSelection) use ($client) {
                $productSelectionReference = ProductSelectionReference::ofId($productSelection->getId());
                $productSelectionSettingDraft = ProductSelectionSettingDraft::of()->setProductSelection($productSelectionReference)->setActive(true);
                StoreFixture::withUpdateableDraftStore(
                    $client,
                    function (StoreDraft $storeDraft) use ($productSelectionSettingDraft) {
                        $storeDraft->setKey("removeProductSelectionStore")
                            ->setName(LocalizedString::ofLangAndText('en', "removeProductSelectionStore"))
                            ->setProductSelections($productSelectionSettingDraft);

                        return $storeDraft;
                    },
                    function (Store $store) use ($client, $productSelectionReference) {
                        $request = RequestBuilder::of()->stores()->update($store)
                            ->addAction(StoreRemoveProductSelectionAction::ofProductSelection($productSelectionReference));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Store::class, $result);
                        $this->assertSame($store->getId(), $result->getId());
                        $this->assertNotSame($store->getVersion(), $result->getVersion());
                        $this->assertEmpty($result->getProductSelections());

                        return $result;
                    }
                );
            }
        );
    }
}
