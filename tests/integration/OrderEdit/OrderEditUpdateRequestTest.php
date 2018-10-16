<?php
/**
 *
 */

namespace Commercetools\Core\OrderEdit;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\Order\OrderReference;
use Commercetools\Core\Model\OrderEdit\OrderEdit;
use Commercetools\Core\Model\OrderEdit\OrderEditDraft;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Order\OrderUpdateRequestTest;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetCommentAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetKeyAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetStagedActionsAction;
use Commercetools\Core\Request\OrderEdits\OrderEditCreateRequest;
use Commercetools\Core\Request\OrderEdits\OrderEditDeleteRequest;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCountryAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomerEmailAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderUpdateActionCollection;

class OrderEditUpdateRequestTest extends OrderUpdateRequestTest
{
    protected function getOrderEditDraft()
    {
        $cartDraft = $this->getCartDraft();
        $orderNumber = (new \DateTime())->format('Y/m/d') . ' ' . $this->getTestRun();
        $order = $this->createOrder($cartDraft, $orderNumber);

        $orderEditDraft = OrderEditDraft::of()->setResource(OrderReference::ofId($order->getId()));
        return $orderEditDraft;
    }

    protected function createOrderEdit($key = null, $customField = null)
    {
        $orderEditDraft = $this->getOrderEditDraft();

        if (!is_null($key)) {
            $orderEditDraft->setKey($key);
        }
        if (!is_null($customField)) {
            $orderEditDraft->setCustom(CustomFieldObjectDraft::of()->setType(TypeReference::ofKey($customField)));
        }

        $request = OrderEditCreateRequest::ofDraft($orderEditDraft);
        $response = $request->executeWithClient($this->getClient());
        $orderEdit = $request->mapResponse($response);

        $this->cleanupRequests[] = $this->deleteRequest = OrderEditDeleteRequest::ofIdAndVersion(
            $orderEdit->getId(),
            $orderEdit->getVersion()
        );

        return $orderEdit;
    }

    public function testOrderEditSetKey()
    {
        $orderEdit = $this->createOrderEdit();
        $this->assertInstanceOf(OrderEdit::class, $orderEdit);

        $request = RequestBuilder::of()->orderEdits()->update($orderEdit)->setActions([
            OrderEditSetKeyAction::ofKey('foo1')
        ])->setDryRun(false);

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($orderEdit->getVersion(), $result->getVersion());
        $this->assertInstanceOf(OrderEdit::class, $result);
        $this->assertSame('foo1', $result->getKey());
    }

    public function testUpdateOrderEditByKeySetComment()
    {
        $orderEdit = $this->createOrderEdit('foo1');
        $this->assertNull($orderEdit->getComment());

        $request = RequestBuilder::of()->orderEdits()->updateByKey($orderEdit)->setActions([
            OrderEditSetCommentAction::of()->setComment('bar')
        ])->setDryRun(true);

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertSame($orderEdit->getVersion(), $result->getVersion());
        $this->assertInstanceOf(OrderEdit::class, $result);
        $this->assertSame('bar', $result->getComment());
    }

    public function testUpdateOrderEditSetCustomType()
    {
        $typeKey = 'type-' . $this->getTestRun();
        $type = $this->getType($typeKey, 'order-edit');

        $orderEdit = $this->createOrderEdit();

        $request = RequestBuilder::of()->orderEdits()->update($orderEdit)->setActions([
            OrderEditSetCustomTypeAction::ofTypeKey($typeKey)
        ]);

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(OrderEdit::class, $result);
        $this->assertSame($type->getId(), $result->getCustom()->getType()->getId());
        $this->assertNotSame($orderEdit->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testUpdateOrderEditSetCustomField()
    {
        $type = $this->getType('order-edit-set-field1', 'order-edit');
        $fieldValue = $this->getTestRun() . '-new value';

        $orderEdit = $this->createOrderEdit(null, 'order-edit-set-field1');

        $request = RequestBuilder::of()->orderEdits()->update($orderEdit)->setActions([
            OrderEditSetCustomFieldAction::ofName('testField')->setValue($fieldValue)
        ]);
        $response = $request->executeWithClient($this->getClient());

        $result = $request->mapResponse($response);

        $this->assertInstanceOf(OrderEdit::class, $result);
        $this->assertSame($type->getId(), $result->getCustom()->getType()->getId());
        $this->assertSame($fieldValue, $result->getCustom()->getFields()->getTestField());
        $this->assertNotSame($orderEdit->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testUpdateOrderEditSetStagedActions()
    {
        $orderEdit = $this->createOrderEdit();
        $this->assertInstanceOf(OrderEdit::class, $orderEdit);

        $request = RequestBuilder::of()->orderEdits()->update($orderEdit)->setActions([
            OrderEditSetStagedActionsAction::of()->setStagedActions(StagedOrderUpdateActionCollection::of()
                ->add(StagedOrderSetCountryAction::of()->setCountry('DE'))
                ->add(StagedOrderSetCustomerEmailAction::of()->setEmail('user@localhost')))
        ]);

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($orderEdit->getVersion(), $result->getVersion());
        $this->assertInstanceOf(OrderEdit::class, $result);
        $stagedActions = $result->getStagedActions();

        $this->assertInstanceOf(StagedOrderUpdateActionCollection::class, $stagedActions);
        $this->assertCount(2, $stagedActions);

        $this->assertJsonStringEqualsJsonString(
            json_encode(['action' => 'setCountry', 'country' => 'DE']),
            json_encode($stagedActions->current())
        );
        $this->assertJsonStringEqualsJsonString(
            json_encode(['action' => 'setCustomerEmail', 'email' => 'user@localhost']),
            json_encode($stagedActions->getAt(1))
        );
    }
}
