<?php
/**
 */

namespace Commercetools\Core\IntegrationTests\Order;

use Commercetools\Core\Builder\Request\ApiClientRequestBuilder;
use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\OrderEdit\OrderEditFixture;
use Commercetools\Core\IntegrationTests\ShippingMethod\ShippingMethodFixture;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\Order\OrderReference;
use Commercetools\Core\Model\OrderEdit\OrderEdit;
use Commercetools\Core\Model\OrderEdit\OrderEditDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\Zone\Zone;
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

        $orderEditDraft = OrderEditDraft::ofResource(OrderReference::ofId($order->getId()));
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
        $client = $this->getApiClient();
        OrderEditFixture::withOrderEdit(
            $client,
            function (OrderEdit $orderEdit) use ($client) {
                $request = RequestBuilder::of()->orderEdits()->getById($orderEdit->getId());
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(OrderEdit::class, $result);
                $this->assertSame($orderEdit->getId(), $result->getId());
            }
        );
    }

    public function testQuery()
    {
        $client = $this->getApiClient();
        OrderEditFixture::withOrderEdit(
            $client,
            function (OrderEdit $orderEdit) use ($client) {
                $request = RequestBuilder::of()->orderEdits()->query()
                    ->where('key = :key', ['key' => $orderEdit->getKey()]);
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(OrderEdit::class, $result->getAt(0));
                $this->assertSame($orderEdit->getId(), $result->getAt(0)->getId());
            }
        );
    }

    //todo to collocate into ShippingMethodQueryRequestTest after migration and add some assertions
    public function testMatchingOrderEdit()
    {
        $client = $this->getApiClient();

        ShippingMethodFixture::withShippingMethod(
            $client,
            function (ShippingMethod $shippingMethod, Zone $zone) use ($client) {
                OrderEditFixture::withOrderEdit(
                    $client,
                    function (OrderEdit $orderEdit) use ($client, $zone) {
                        $request = RequestBuilder::of()->shippingMethods()
                            ->getMatchingOrderEdit($orderEdit->getId(), $zone->getLocations()->current());
                        $response = $this->execute($client, $request, ['X-Vrap-Disable-Validation' => 'response']);
                        $result = $request->mapFromResponse($response);

                        $this->assertTrue(
                            $result->current()->getZoneRates()->current()->getShippingRates()->current()->getIsMatching()
                        );
                        $this->assertInstanceOf(ShippingMethodCollection::class, $result);
                        $this->assertInstanceOf(TaxCategoryReference::class, $result->current()->getTaxCategory());
                    }
                );
            }
        );
    }
}
