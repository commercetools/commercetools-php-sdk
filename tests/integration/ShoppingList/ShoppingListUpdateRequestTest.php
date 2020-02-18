<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\ShoppingList;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\Customer\CustomerFixture;
use Commercetools\Core\IntegrationTests\Product\ProductFixture;
use Commercetools\Core\IntegrationTests\Type\TypeFixture;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\ShoppingList\LineItemDraft;
use Commercetools\Core\Model\ShoppingList\LineItemDraftCollection;
use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Model\ShoppingList\ShoppingListDraft;
use Commercetools\Core\Model\ShoppingList\TextLineItemDraft;
use Commercetools\Core\Model\ShoppingList\TextLineItemDraftCollection;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Type\TypeDraft;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListAddLineItemAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListAddTextLineItemAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeLineItemQuantityAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeNameAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeTextLineItemQuantityAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListRemoveLineItemAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListRemoveTextLineItemAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetCustomerAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetCustomFieldAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetCustomTypeAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetDeleteDaysAfterLastModificationAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetDescriptionAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetKeyAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetLineItemCustomFieldAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetLineItemCustomTypeAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetSlugAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetTextLineItemCustomFieldAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetTextLineItemCustomTypeAction;
use Commercetools\Core\Request\ShoppingLists\ShoppingListCreateRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListDeleteRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListUpdateRequest;

class ShoppingListUpdateRequestTest extends ApiTestCase
{
    /**
     * @return ShoppingListDraft
     */
    protected function getDraft($name)
    {
        $draft = ShoppingListDraft::ofNameAndKey(
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-' . $name),
            'key-' . $this->getTestRun()
        );

        return $draft;
    }

    protected function createShoppingList(ShoppingListDraft $draft)
    {
        /**
         * @var ShoppingList $shoppingList
         */
        $request = ShoppingListCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());

        $shoppingList = $request->mapResponse($response);
        $this->cleanupRequests[] = $this->deleteRequest = ShoppingListDeleteRequest::ofIdAndVersion(
            $shoppingList->getId(),
            $shoppingList->getVersion()
        );

        return $shoppingList;
    }

    /**
     * @param Product $product
     * @return LineItemDraftCollection
     */
    private function getLineItemDraftCollection(Product $product)
    {
        return LineItemDraftCollection::of()->add(
            LineItemDraft::ofProductIdVariantIdAndQuantity(
                $product->getId(),
                $product->getMasterData()->getCurrent()->getMasterVariant()->getId(),
                1
            )
        );
    }

    public function testChangeByKey()
    {
        $client = $this->getApiClient();

        ShoppingListFixture::withUpdateableShoppingList(
            $client,
            function (ShoppingList $shoppingList) use ($client) {
                $name = 'new-name-' . ShoppingListFixture::uniqueShoppingListString();

                $request = RequestBuilder::of()->shoppingLists()->updateByKey($shoppingList)
                    ->addAction(ShoppingListChangeNameAction::ofName(LocalizedString::ofLangAndText('en', $name)));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShoppingList::class, $result);
                $this->assertSame($name, $result->getName()->en);

                return $result;
            }
        );
    }

    public function testSetKey()
    {
        $client = $this->getApiClient();

        ShoppingListFixture::withUpdateableShoppingList(
            $client,
            function (ShoppingList $shoppingList) use ($client) {
                $key = 'new-' . ShoppingListFixture::uniqueShoppingListString();

                $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                    ->addAction(ShoppingListSetKeyAction::ofKey($key));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShoppingList::class, $result);
                $this->assertSame($key, $result->getKey());

                return $result;
            }
        );
    }

    public function testChangeKeyLength()
    {
        $client = $this->getApiClient();

        ShoppingListFixture::withUpdateableDraftShoppingList(
            $client,
            function (ShoppingListDraft $draft) {
                return  $draft->setKey(str_pad($draft->getKey(), 256, '0'));
            },
            function (ShoppingList $shoppingList) use ($client) {
                $key = str_pad('new-' . ShoppingListFixture::uniqueShoppingListString(), 256, '0');

                $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                    ->addAction(ShoppingListSetKeyAction::ofKey($key));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShoppingList::class, $result);
                $this->assertSame($key, $result->getKey());

                return $result;
            }
        );
    }

    public function testChangeName()
    {
        $client = $this->getApiClient();

        ShoppingListFixture::withUpdateableShoppingList(
            $client,
            function (ShoppingList $shoppingList) use ($client) {
                $name = 'new-' . ShoppingListFixture::uniqueShoppingListString();

                $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                    ->addAction(ShoppingListChangeNameAction::ofName(LocalizedString::ofLangAndText('en', $name)));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShoppingList::class, $result);
                $this->assertSame($name, $result->getName()->en);

                return $result;
            }
        );
    }

    public function testSetSlug()
    {
        $client = $this->getApiClient();

        ShoppingListFixture::withUpdateableShoppingList(
            $client,
            function (ShoppingList $shoppingList) use ($client) {
                $slug = 'new-slug-' . ShoppingListFixture::uniqueShoppingListString();

                $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                    ->addAction(ShoppingListSetSlugAction::ofSlug(LocalizedString::ofLangAndText('en', $slug)));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShoppingList::class, $result);
                $this->assertSame($slug, $result->getSlug()->en);

                return $result;
            }
        );
    }

    public function testSetDescription()
    {
        $client = $this->getApiClient();

        ShoppingListFixture::withUpdateableShoppingList(
            $client,
            function (ShoppingList $shoppingList) use ($client) {
                $description = 'new-description-' . ShoppingListFixture::uniqueShoppingListString();

                $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                    ->addAction(
                        ShoppingListSetDescriptionAction::ofDescription(
                            LocalizedString::ofLangAndText('en', $description)
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShoppingList::class, $result);
                $this->assertSame($description, $result->getDescription()->en);

                return $result;
            }
        );
    }

    public function testSetCustomer()
    {
        $client = $this->getApiClient();

        CustomerFixture::withCustomer(
            $client,
            function (Customer $customer) use ($client) {
                ShoppingListFixture::withUpdateableShoppingList(
                    $client,
                    function (ShoppingList $shoppingList) use ($client, $customer) {
                        $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                            ->addAction(ShoppingListSetCustomerAction::ofCustomer($customer->getReference()));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ShoppingList::class, $result);
                        $this->assertSame($customer->getId(), $result->getCustomer()->getId());

                        return $result;
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
            function (TypeDraft $typeDraft) {
                return $typeDraft->setKey('shopping-list-set-type')->setResourceTypeIds(['shopping-list']);
            },
            function (Type $type) use ($client) {
                ShoppingListFixture::withUpdateableShoppingList(
                    $client,
                    function (ShoppingList $shoppingList) use ($client, $type) {
                        $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                            ->addAction(
                                ShoppingListSetCustomTypeAction::ofTypeKey('shopping-list-set-type')
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ShoppingList::class, $result);
                        $this->assertSame($type->getId(), $result->getCustom()->getType()->getId());

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
            function (TypeDraft $typeDraft) {
                return $typeDraft->setKey('shopping-list-set-field')->setResourceTypeIds(['shopping-list']);
            },
            function (Type $type) use ($client) {
                ShoppingListFixture::withUpdateableDraftShoppingList(
                    $client,
                    function (ShoppingListDraft $draft) {
                        return $draft->setCustom(CustomFieldObjectDraft::ofTypeKey('shopping-list-set-field'));
                    },
                    function (ShoppingList $shoppingList) use ($client, $type) {
                        $fieldValue = 'new value-' . ShoppingListFixture::uniqueShoppingListString();

                        $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                            ->addAction(
                                ShoppingListSetCustomFieldAction::ofName('testField')->setValue($fieldValue)
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ShoppingList::class, $result);
                        $this->assertSame($type->getId(), $result->getCustom()->getType()->getId());
                        $this->assertSame($fieldValue, $result->getCustom()->getFields()->getTestField());

                        return $result;
                    }
                );
            }
        );
    }

    public function testAddLineItem()
    {
        $client = $this->getApiClient();

        ProductFixture::withDraftProduct(
            $client,
            function (ProductDraft $productDraft) {
                return $productDraft->setPublish(true);
            },
            function (Product $product) use ($client) {
                ShoppingListFixture::withUpdateableShoppingList(
                    $client,
                    function (ShoppingList $shoppingList) use ($client, $product) {
                        $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                            ->addAction(ShoppingListAddLineItemAction::ofProductIdVariantIdAndQuantity(
                                $product->getId(),
                                $product->getMasterData()->getCurrent()->getMasterVariant()->getId(),
                                1
                            ));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ShoppingList::class, $result);
                        $this->assertSame($product->getId(), $result->getLineItems()->current()->getProductId());

                        return $result;
                    }
                );
            }
        );
    }

    public function testRemoveLineItem()
    {
        $client = $this->getApiClient();

        ProductFixture::withDraftProduct(
            $client,
            function (ProductDraft $productDraft) {
                return $productDraft->setPublish(true);
            },
            function (Product $product) use ($client) {
                ShoppingListFixture::withUpdateableDraftShoppingList(
                    $client,
                    function (ShoppingListDraft $shoppingListDraft) use ($product) {
                        return $shoppingListDraft->setLineItems($this->getLineItemDraftCollection($product));
                    },
                    function (ShoppingList $shoppingList) use ($client, $product) {
                        $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                            ->addAction(ShoppingListRemoveLineItemAction::ofLineItemId(
                                $shoppingList->getLineItems()->current()->getId()
                            ));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ShoppingList::class, $result);
                        $this->assertCount(0, $result->getLineItems());

                        return $result;
                    }
                );
            }
        );
    }

    public function testChangeQuantityLineItem()
    {
        $client = $this->getApiClient();

        ProductFixture::withDraftProduct(
            $client,
            function (ProductDraft $productDraft) {
                return $productDraft->setPublish(true);
            },
            function (Product $product) use ($client) {
                ShoppingListFixture::withUpdateableDraftShoppingList(
                    $client,
                    function (ShoppingListDraft $shoppingListDraft) use ($product) {
                        return $shoppingListDraft->setLineItems($this->getLineItemDraftCollection($product));
                    },
                    function (ShoppingList $shoppingList) use ($client, $product) {
                        $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                            ->addAction(ShoppingListChangeLineItemQuantityAction::ofLineItemIdAndQuantity(
                                $shoppingList->getLineItems()->current()->getId(),
                                2
                            ));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ShoppingList::class, $result);
                        $this->assertSame($product->getId(), $result->getLineItems()->current()->getProductId());
                        $this->assertSame(2, $result->getLineItems()->current()->getQuantity());

                        return $result;
                    }
                );
            }
        );
    }

    public function testSetLineItemCustomType()
    {
        $client = $this->getApiClient();
        $typeKey = 'shopping-list-lineitem-set-field';

        TypeFixture::withDraftType(
            $client,
            function (TypeDraft $typeDraft) use ($typeKey) {
                return $typeDraft->setKey($typeKey)
                    ->setResourceTypeIds(['line-item']);
            },
            function (Type $type) use ($client, $typeKey) {
                ProductFixture::withDraftProduct(
                    $client,
                    function (ProductDraft $productDraft) {
                        return $productDraft->setPublish(true);
                    },
                    function (Product $product) use ($client, $type, $typeKey) {
                        ShoppingListFixture::withUpdateableDraftShoppingList(
                            $client,
                            function (ShoppingListDraft $shoppingListDraft) use ($product) {
                                return $shoppingListDraft->setLineItems($this->getLineItemDraftCollection($product));
                            },
                            function (ShoppingList $shoppingList) use ($client, $product, $type, $typeKey) {
                                $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                                    ->addAction(
                                        ShoppingListSetLineItemCustomTypeAction::ofTypeKeyAndLineItemId(
                                            $typeKey,
                                            $shoppingList->getLineItems()->current()->getId()
                                        )
                                    );
                                $response = $this->execute($client, $request);
                                $result = $request->mapFromResponse($response);

                                $this->assertInstanceOf(ShoppingList::class, $result);
                                $this->assertSame(
                                    $type->getId(),
                                    $result->getLineItems()->current()->getCustom()->getType()->getId()
                                );

                                return $result;
                            }
                        );
                    }
                );
            }
        );
    }

    public function testSetLineItemCustomField()
    {
        $client = $this->getApiClient();
        $typeKey = 'shopping-list-lineitem-set-field';

        TypeFixture::withDraftType(
            $client,
            function (TypeDraft $typeDraft) use ($typeKey) {
                return $typeDraft->setKey($typeKey)
                    ->setResourceTypeIds(['line-item']);
            },
            function (Type $type) use ($client, $typeKey) {
                ProductFixture::withDraftProduct(
                    $client,
                    function (ProductDraft $productDraft) {
                        return $productDraft->setPublish(true);
                    },
                    function (Product $product) use ($client, $type, $typeKey) {
                        ShoppingListFixture::withUpdateableDraftShoppingList(
                            $client,
                            function (ShoppingListDraft $shoppingListDraft) use ($product, $typeKey) {
                                return $shoppingListDraft->setLineItems(LineItemDraftCollection::of()->add(
                                    LineItemDraft::ofProductIdVariantIdAndQuantity(
                                        $product->getId(),
                                        $product->getMasterData()->getCurrent()->getMasterVariant()->getId(),
                                        1
                                    )->setCustom(CustomFieldObjectDraft::ofTypeKey($typeKey))
                                ));
                            },
                            function (ShoppingList $shoppingList) use ($client, $product, $type, $typeKey) {
                                $fieldValue = 'new value-' . ShoppingListFixture::uniqueShoppingListString();

                                $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                                    ->addAction(
                                        ShoppingListSetLineItemCustomFieldAction::ofLineItemIdAndName(
                                            $shoppingList->getLineItems()->current()->getId(),
                                            'testField'
                                        )->setValue($fieldValue)
                                    );
                                $response = $this->execute($client, $request);
                                $result = $request->mapFromResponse($response);

                                $this->assertInstanceOf(ShoppingList::class, $result);
                                $this->assertSame(
                                    $fieldValue,
                                    $result->getLineItems()->current()->getCustom()->getFields()->getTestField()
                                );

                                return $result;
                            }
                        );
                    }
                );
            }
        );
    }

    public function testAddTextLineItem()
    {
        $client = $this->getApiClient();

        ShoppingListFixture::withUpdateableShoppingList(
            $client,
            function (ShoppingList $shoppingList) use ($client) {
                $name = 'text line item name-' . ShoppingListFixture::uniqueShoppingListString();

                $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                    ->addAction(
                        ShoppingListAddTextLineItemAction::ofName(
                            LocalizedString::ofLangAndText('en', $name)
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShoppingList::class, $result);
                $this->assertSame($name, $result->getTextLineItems()->current()->getName()->en);

                return $result;
            }
        );
    }

    public function testRemoveTextLineItem()
    {
        $client = $this->getApiClient();

        ShoppingListFixture::withUpdateableDraftShoppingList(
            $client,
            function (ShoppingListDraft $draft) {
                $name = 'text line item name-' . ShoppingListFixture::uniqueShoppingListString();

                return $draft->setTextLineItems(TextLineItemDraftCollection::of()->add(
                    TextLineItemDraft::ofName(LocalizedString::ofLangAndText('en', $name))
                ));
            },
            function (ShoppingList $shoppingList) use ($client) {
                $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                    ->addAction(
                        ShoppingListRemoveTextLineItemAction::ofTextLineItemId(
                            $shoppingList->getTextLineItems()->current()->getId()
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShoppingList::class, $result);
                $this->assertCount(0, $result->getTextLineItems());

                return $result;
            }
        );
    }

    public function testChangeQuantityTextLineItem()
    {
        $client = $this->getApiClient();
        $name = 'text line item name-' . ShoppingListFixture::uniqueShoppingListString();

        ShoppingListFixture::withUpdateableDraftShoppingList(
            $client,
            function (ShoppingListDraft $draft) use ($name) {
                return $draft->setTextLineItems(TextLineItemDraftCollection::of()->add(
                    TextLineItemDraft::ofName(LocalizedString::ofLangAndText('en', $name))
                ));
            },
            function (ShoppingList $shoppingList) use ($client, $name) {
                $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                    ->addAction(
                        ShoppingListChangeTextLineItemQuantityAction::ofTextLineItemIdAndQuantity(
                            $shoppingList->getTextLineItems()->current()->getId(),
                            2
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShoppingList::class, $result);
                $this->assertSame($name, $result->getTextLineItems()->current()->getName()->en);
                $this->assertSame(2, $result->getTextLineItems()->current()->getQuantity());

                return $result;
            }
        );
    }

    public function testSetTextLineItemCustomType()
    {
        $client = $this->getApiClient();
        $name = 'text line item name-' . ShoppingListFixture::uniqueShoppingListString();

        TypeFixture::withDraftType(
            $client,
            function (TypeDraft $typeDraft) {
                return $typeDraft->setKey('shopping-list-textLineItem-set-field')
                ->setResourceTypeIds(['shopping-list-text-line-item']);
            },
            function (Type $type) use ($client, $name) {
                ShoppingListFixture::withUpdateableDraftShoppingList(
                    $client,
                    function (ShoppingListDraft $draft) use ($name) {
                        return $draft->setTextLineItems(TextLineItemDraftCollection::of()->add(
                            TextLineItemDraft::ofName(LocalizedString::ofLangAndText('en', $name))
                        ));
                    },
                    function (ShoppingList $shoppingList) use ($client, $type) {
                        $fieldValue = 'new value-' . ShoppingListFixture::uniqueShoppingListString();

                        $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                        ->addAction(
                            ShoppingListSetTextLineItemCustomTypeAction::ofTypeKeyAndTextLineItemId(
                                $type->getKey(),
                                $shoppingList->getTextLineItems()->current()->getId()
                            )
                        );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ShoppingList::class, $result);
                        $this->assertSame(
                            $type->getId(),
                            $result->getTextLineItems()->current()->getCustom()->getType()->getId()
                        );

                        return $result;
                    }
                );
            }
        );
    }

    public function testSetTextLineItemCustomField()
    {
        $client = $this->getApiClient();
        $name = 'text line item name-' . ShoppingListFixture::uniqueShoppingListString();

        TypeFixture::withDraftType(
            $client,
            function (TypeDraft $typeDraft) {
                return $typeDraft->setKey('shopping-list-textLineItem-set-field')
                    ->setResourceTypeIds(['shopping-list-text-line-item']);
            },
            function (Type $type) use ($client, $name) {
                ShoppingListFixture::withUpdateableDraftShoppingList(
                    $client,
                    function (ShoppingListDraft $draft) use ($name) {
                        return $draft->setTextLineItems(TextLineItemDraftCollection::of()->add(
                            TextLineItemDraft::ofName(LocalizedString::ofLangAndText('en', $name))
                                ->setCustom(CustomFieldObjectDraft::ofTypeKey('shopping-list-textLineItem-set-field'))
                        ));
                    },
                    function (ShoppingList $shoppingList) use ($client, $type) {
                        $fieldValue = 'new value-' . ShoppingListFixture::uniqueShoppingListString();

                        $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                            ->addAction(
                                ShoppingListSetTextLineItemCustomFieldAction::ofTextLineItemIdAndName(
                                    $shoppingList->getTextLineItems()->current()->getId(),
                                    'testField'
                                )->setValue($fieldValue)
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ShoppingList::class, $result);
                        $this->assertSame(
                            $fieldValue,
                            $result->getTextLineItems()->current()->getCustom()->getFields()->getTestField()
                        );

                        return $result;
                    }
                );
            }
        );
    }
    public function testSetDeleteDaysAfterLastModification()
    {
        $client = $this->getApiClient();

        ShoppingListFixture::withUpdateableShoppingList(
            $client,
            function (ShoppingList $shoppingList) use ($client) {
                $days = 5;

                $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                    ->addAction(
                        ShoppingListSetDeleteDaysAfterLastModificationAction::of()
                            ->setDeleteDaysAfterLastModification($days)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShoppingList::class, $result);
                $this->assertSame($days, $result->getDeleteDaysAfterLastModification());

                return $result;
            }
        );
    }

    public function testAddLineItemBySku()
    {
        $client = $this->getApiClient();

        ProductFixture::withDraftProduct(
            $client,
            function (ProductDraft $productDraft) {
                return $productDraft->setPublish(true);
            },
            function (Product $product) use ($client) {
                $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

                ShoppingListFixture::withUpdateableDraftShoppingList(
                    $client,
                    function (ShoppingListDraft $shoppingListDraft) use ($product, $variant) {
                        return $shoppingListDraft
                            ->setLineItems(
                                LineItemDraftCollection::of()->add(LineItemDraft::ofSku($variant->getSku()))
                            );
                    },
                    function (ShoppingList $shoppingList) use ($client, $product, $variant) {
                        $this->assertSame(1, $shoppingList->getLineItems()->current()->getQuantity());

                        $request = RequestBuilder::of()->shoppingLists()->update($shoppingList)
                            ->addAction(ShoppingListAddLineItemAction::ofSkuAndQuantity(
                                $variant->getSku(),
                                1
                            ));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ShoppingList::class, $result);
                        $this->assertSame(2, $result->getLineItems()->current()->getQuantity());
                        $this->assertSame($product->getId(), $result->getLineItems()->current()->getProductId());
                    }
                );
            }
        );
    }
}
