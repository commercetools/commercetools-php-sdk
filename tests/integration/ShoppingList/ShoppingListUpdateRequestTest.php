<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\ShoppingList;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Model\Common\EnumCollection;
use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Model\Common\LocalizedEnumCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\ShoppingList\EnumShoppingList;
use Commercetools\Core\Model\ShoppingList\FieldDefinition;
use Commercetools\Core\Model\ShoppingList\FieldDefinitionCollection;
use Commercetools\Core\Model\ShoppingList\LineItemDraft;
use Commercetools\Core\Model\ShoppingList\LineItemDraftCollection;
use Commercetools\Core\Model\ShoppingList\LocalizedEnumShoppingList;
use Commercetools\Core\Model\ShoppingList\StringShoppingList;
use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Model\ShoppingList\ShoppingListDraft;
use Commercetools\Core\Model\ShoppingList\TextLineItemDraft;
use Commercetools\Core\Model\ShoppingList\TextLineItemDraftCollection;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListAddEnumValueAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListAddFieldDefinitionAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListAddLineItemAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListAddLocalizedEnumValueAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListAddTextLineItemAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeKeyAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeLabelAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeLineItemQuantityAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeNameAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeTextLineItemQuantityAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListRemoveFieldDefinitionAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListRemoveLineItemAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListRemoveTextLineItemAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetCustomerAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetCustomFieldAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetCustomTypeAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetDescriptionAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetKeyAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetLineItemCustomFieldAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetLineItemCustomTypeAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetSlugAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetTextLineItemCustomFieldAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetTextLineItemCustomTypeAction;
use Commercetools\Core\Request\ShoppingLists\ShoppingListCreateRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListDeleteRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListUpdateByKeyRequest;
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

    public function testChangeByKey()
    {
        $draft = $this->getDraft('change-by-key');
        $shoppingList = $this->createShoppingList($draft);

        $name = $this->getTestRun() . '-new name';
        $request = ShoppingListUpdateByKeyRequest::ofKeyAndVersion($shoppingList->getKey(), $shoppingList->getVersion())
            ->addAction(ShoppingListChangeNameAction::ofName(LocalizedString::ofLangAndText('en', $name)))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($name, $result->getName()->en);
    }

    public function testSetKey()
    {
        $draft = $this->getDraft('set-key');
        $shoppingList = $this->createShoppingList($draft);

        $key = 'new-' . $this->getTestRun();
        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(ShoppingListSetKeyAction::ofKey($key))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($key, $result->getKey());
    }

    public function testChangeKeyLength()
    {
        $draft = $this->getDraft('change-key');
        $draft->setKey(str_pad($draft->getKey(), 256, '0'));
        $shoppingList = $this->createShoppingList($draft);

        $key = str_pad('new-' . $this->getTestRun(), 256, '0');
        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(ShoppingListSetKeyAction::ofKey($key))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($key, $result->getKey());
    }

    public function testChangeName()
    {
        $draft = $this->getDraft('change-name');
        $shoppingList = $this->createShoppingList($draft);

        $name = $this->getTestRun() . '-new name';
        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(ShoppingListChangeNameAction::ofName(LocalizedString::ofLangAndText('en', $name)))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($name, $result->getName()->en);
    }

    public function testSetSlug()
    {
        $draft = $this->getDraft('set-slug');
        $shoppingList = $this->createShoppingList($draft);

        $slug = $this->getTestRun() . '-new-slug';
        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(ShoppingListSetSlugAction::ofSlug(LocalizedString::ofLangAndText('en', $slug)))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());
        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($slug, $result->getSlug()->en);
    }

    public function testSetDescription()
    {
        $draft = $this->getDraft('set-description');
        $shoppingList = $this->createShoppingList($draft);

        $description = $this->getTestRun() . '-new description';
        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(ShoppingListSetDescriptionAction::ofDescription(LocalizedString::ofLangAndText('en', $description)))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($description, $result->getDescription()->en);
    }

    public function testSetCustomer()
    {
        $draft = $this->getDraft('set-customer');
        $shoppingList = $this->createShoppingList($draft);

        $customer = $this->getCustomer();
        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(ShoppingListSetCustomerAction::ofCustomer($customer->getReference()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($customer->getId(), $result->getCustomer()->getId());
    }

    public function testSetCustomType()
    {
        $draft = $this->getDraft('set-custom-type');
        $shoppingList = $this->createShoppingList($draft);

        $type = $this->getType('shopping-list-set-type', 'shopping-list');
        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(ShoppingListSetCustomTypeAction::ofTypeKey('shopping-list-set-type'))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($type->getId(), $result->getCustom()->getType()->getId());
    }

    public function testSetCustomField()
    {
        $type = $this->getType('shopping-list-set-field', 'shopping-list');
        $draft = $this->getDraft('set-custom-field');
        $draft->setCustom(CustomFieldObjectDraft::ofTypeKey('shopping-list-set-field'));
        $shoppingList = $this->createShoppingList($draft);

        $fieldValue = $this->getTestRun() . '-new value';
        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(ShoppingListSetCustomFieldAction::ofName('testField')->setValue($fieldValue))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($type->getId(), $result->getCustom()->getType()->getId());
        $this->assertSame($fieldValue, $result->getCustom()->getFields()->getTestField());
    }

    public function testAddLineItem()
    {
        $product = $this->getProduct();
        $draft = $this->getDraft('add-line-item');
        $shoppingList = $this->createShoppingList($draft);

        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(ShoppingListAddLineItemAction::ofProductIdVariantIdAndQuantity(
                $product->getId(),
                $product->getMasterData()->getCurrent()->getMasterVariant()->getId(),
                1
            ))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($product->getId(), $result->getLineItems()->current()->getProductId());
    }

    public function testRemoveLineItem()
    {
        $product = $this->getProduct();
        $draft = $this->getDraft('remove-line-item');
        $draft->setLineItems(LineItemDraftCollection::of()->add(
            LineItemDraft::of()->setProductId($product->getId())
                ->setVariantId($product->getMasterData()->getCurrent()->getMasterVariant()->getId())
                ->setQuantity(1)
        ));
        $shoppingList = $this->createShoppingList($draft);

        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(ShoppingListRemoveLineItemAction::ofLineItemId(
                $shoppingList->getLineItems()->current()->getId()
            ))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertCount(0, $result->getLineItems());
    }

    public function testChangeQuantityLineItem()
    {
        $product = $this->getProduct();
        $draft = $this->getDraft('change-line-item');
        $draft->setLineItems(LineItemDraftCollection::of()->add(
            LineItemDraft::of()->setProductId($product->getId())
                ->setVariantId($product->getMasterData()->getCurrent()->getMasterVariant()->getId())
                ->setQuantity(1)
        ));
        $shoppingList = $this->createShoppingList($draft);

        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(ShoppingListChangeLineItemQuantityAction::ofLineItemIdAndQuantity(
                $shoppingList->getLineItems()->current()->getId(),
                2
            ))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($product->getId(), $result->getLineItems()->current()->getProductId());
        $this->assertSame(2, $result->getLineItems()->current()->getQuantity());
    }

    public function testSetLineItemCustomType()
    {
        $type = $this->getType('shopping-list-lineitem-set-field', 'line-item');
        $product = $this->getProduct();
        $draft = $this->getDraft('set-line-item-custom-type');
        $draft->setLineItems(LineItemDraftCollection::of()->add(
            LineItemDraft::of()->setProductId($product->getId())
                ->setVariantId($product->getMasterData()->getCurrent()->getMasterVariant()->getId())
                ->setQuantity(1)
        ));
        $shoppingList = $this->createShoppingList($draft);

        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(
                ShoppingListSetLineItemCustomTypeAction::ofTypeKeyAndLineItemId(
                    'shopping-list-lineitem-set-field',
                    $shoppingList->getLineItems()->current()->getId()
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($type->getId(), $result->getLineItems()->current()->getCustom()->getType()->getId());
    }

    public function testSetLineItemCustomField()
    {
        $type = $this->getType('shopping-list-lineitem-set-field', 'line-item');
        $product = $this->getProduct();
        $draft = $this->getDraft('set-line-item-custom-type');
        $draft->setLineItems(LineItemDraftCollection::of()->add(
            LineItemDraft::of()->setProductId($product->getId())
                ->setVariantId($product->getMasterData()->getCurrent()->getMasterVariant()->getId())
                ->setQuantity(1)
                ->setCustom(CustomFieldObjectDraft::ofTypeKey('shopping-list-lineitem-set-field'))
        ));
        $shoppingList = $this->createShoppingList($draft);

        $fieldValue = $this->getTestRun() . '-new value';
        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(
                ShoppingListSetLineItemCustomFieldAction::ofLineItemIdAndName(
                    $shoppingList->getLineItems()->current()->getId(),
                    'testField'
                )->setValue($fieldValue)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($fieldValue, $result->getLineItems()->current()->getCustom()->getFields()->getTestField());
    }

    public function testAddTextLineItem()
    {
        $draft = $this->getDraft('add-text-line-item');
        $shoppingList = $this->createShoppingList($draft);

        $name = $this->getTestRun() . '-text line item name';
        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(ShoppingListAddTextLineItemAction::ofName(
                LocalizedString::ofLangAndText('en', $name)
            ))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($name, $result->getTextLineItems()->current()->getName()->en);
    }

    public function testRemoveTextLineItem()
    {
        $name = $this->getTestRun() . '-text line item name';
        $draft = $this->getDraft('remove-text-line-item');
        $draft->setTextLineItems(TextLineItemDraftCollection::of()->add(
            TextLineItemDraft::of()->setName(LocalizedString::ofLangAndText('en', $name))
        ));
        $shoppingList = $this->createShoppingList($draft);

        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(ShoppingListRemoveTextLineItemAction::ofTextLineItemId(
                $shoppingList->getTextLineItems()->current()->getId()
            ))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertCount(0, $result->getTextLineItems());
    }

    public function testChangeQuantityTextLineItem()
    {
        $name = $this->getTestRun() . '-text line item name';
        $draft = $this->getDraft('change-text-line-item');
        $draft->setTextLineItems(TextLineItemDraftCollection::of()->add(
            TextLineItemDraft::of()->setName(LocalizedString::ofLangAndText('en', $name))
        ));
        $shoppingList = $this->createShoppingList($draft);

        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(ShoppingListChangeTextLineItemQuantityAction::ofTextLineItemIdAndQuantity(
                $shoppingList->getTextLineItems()->current()->getId(),
                2
            ))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($name, $result->getTextLineItems()->current()->getName()->en);
        $this->assertSame(2, $result->getTextLineItems()->current()->getQuantity());
    }

    public function testSetTextLineItemCustomType()
    {
        $type = $this->getType('shopping-list-textLineItem-set-field', 'shopping-list-text-line-item');
        $draft = $this->getDraft('set-line-item-custom-type');
        $name = $this->getTestRun() . '-text line item name';
        $draft->setTextLineItems(TextLineItemDraftCollection::of()->add(
            TextLineItemDraft::of()->setName(LocalizedString::ofLangAndText('en', $name))
        ));
        $shoppingList = $this->createShoppingList($draft);

        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(
                ShoppingListSetTextLineItemCustomTypeAction::ofTypeKeyAndTextLineItemId(
                    'shopping-list-textLineItem-set-field',
                    $shoppingList->getTextLineItems()->current()->getId()
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($type->getId(), $result->getTextLineItems()->current()->getCustom()->getType()->getId());
    }

    public function testSetTextLineItemCustomField()
    {
        $type = $this->getType('shopping-list-textLineItem-set-field', 'shopping-list-text-line-item');
        $draft = $this->getDraft('set-line-item-custom-type');
        $name = $this->getTestRun() . '-text line item name';
        $draft->setTextLineItems(TextLineItemDraftCollection::of()->add(
            TextLineItemDraft::of()->setName(LocalizedString::ofLangAndText('en', $name))
                ->setCustom(CustomFieldObjectDraft::ofTypeKey('shopping-list-textLineItem-set-field'))
        ));
        $shoppingList = $this->createShoppingList($draft);

        $fieldValue = $this->getTestRun() . '-new value';
        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion())
            ->addAction(
                ShoppingListSetTextLineItemCustomFieldAction::ofTextLineItemIdAndName(
                    $shoppingList->getTextLineItems()->current()->getId(),
                    'testField'
                )->setValue($fieldValue)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\ShoppingList\ShoppingList', $result);
        $this->assertSame($fieldValue, $result->getTextLineItems()->current()->getCustom()->getFields()->getTestField());
    }
}
