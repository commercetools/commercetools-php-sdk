<?php
/**
 */

namespace Commercetools\Core\IntegrationTests\Order;

use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\Order\OrderReference;
use Commercetools\Core\Model\OrderEdit\OrderEdit;
use Commercetools\Core\Model\OrderEdit\OrderEditDraft;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Request\OrderEdits\OrderEditByIdGetRequest;
use Commercetools\Core\Request\OrderEdits\OrderEditCreateRequest;
use Commercetools\Core\Request\OrderEdits\OrderEditDeleteRequest;
use Commercetools\Core\Request\OrderEdits\OrderEditQueryRequest;

class OrderEditQueryRequestTest extends OrderQueryRequestTest
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
            $orderEditDraft->setCustom(CustomFieldObjectDraft::ofTypeKey(TypeReference::ofKey($customField)));
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

    public function testGetById()
    {
        $orderEdit = $this->createOrderEdit();

        $request = OrderEditByIdGetRequest::ofId($orderEdit->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(OrderEdit::class, $result);
        $this->assertSame($orderEdit->getId(), $result->getId());
    }

    public function testQuery()
    {
        $orderEdit = $this->createOrderEdit('foo-' . $this->getTestRun());

        $request = OrderEditQueryRequest::of()->where(
            'key="' . $orderEdit->getKey() . '"'
        );

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(OrderEdit::class, $result->getAt(0));
        $this->assertSame($orderEdit->getId(), $result->getAt(0)->getId());
    }
}
