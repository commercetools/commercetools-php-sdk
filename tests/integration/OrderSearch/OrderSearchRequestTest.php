<?php

namespace Commercetools\Core\IntegrationTests\Order;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Request\Orders\OrderCreateFromCartRequest;

class OrderSearchRequestTest extends ApiTestCase
{
    public function testOrderByOrderNumber()
    {
        $client = $this->getApiClient();
        $orderNumber = (new \DateTime())->format('Y/m/d') . ' ' . OrderFixture::uniqueOrderString();

        OrderFixture::withUpdateableDraftOrder(
            $client,
            function (OrderCreateFromCartRequest $request) use ($orderNumber) {
                return $request->setOrderNumber($orderNumber);
            },
            function (Order $order) use ($client, $orderNumber) {
                $request = RequestBuilder::of()->orders()->search();
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Order::class, $result);

                return $result;
            }
        );
    }
}
