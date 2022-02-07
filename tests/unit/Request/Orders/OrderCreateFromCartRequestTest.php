<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Model\State\StateReference;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\ResourceResponse;

/**
 * Class OrderCreateFromCartRequestTest
 * @package Commercetools\Core\Request\Orders
 */
class OrderCreateFromCartRequestTest extends RequestTestCase
{
    const ORDER_CREATE_REQUEST = OrderCreateFromCartRequest::class;

    public function testMapResult()
    {
        $result = $this->mapResult(OrderCreateFromCartRequest::ofCartIdAndVersion('12345', 1));
        $this->assertInstanceOf(Order::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(OrderCreateFromCartRequest::ofCartIdAndVersion('12345', 1));
        $this->assertNull($result);
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = OrderCreateFromCartRequest::ofCartIdAndVersion('12345', 1);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(ResourceResponse::class, $response);
    }

    public function testHttpRequestMethod()
    {
        $request = OrderCreateFromCartRequest::ofCartIdAndVersion('12345', 1);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = OrderCreateFromCartRequest::ofCartIdAndVersion('12345', 1);
        $httpRequest = $request->httpRequest();

        $this->assertSame('orders', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        /**
         * @var OrderCreateFromCartRequest $request
         */
        $request = OrderCreateFromCartRequest::ofCartIdAndVersion('12345', 1);
        $stateReference = StateReference::ofId('123');
        $request->setOrderNumber('12345678')
            ->setPaymentState('paid')
            ->setOrderState('Confirmed')
            ->setShipmentState('Ready')
            ->setState($stateReference);

        $httpRequest = $request->httpRequest();

        $expectedResult = [
            "cart" => [
                "id" =>  "12345",
                "typeId" => "cart"
            ],
            'version' => 1,
            'orderNumber' => '12345678',
            'paymentState' => 'paid',
            'orderState' => 'Confirmed',
            'shipmentState' => 'Ready',
            'state' => [
                'typeId' => 'state',
                'id' => '123'
            ]
        ];
        $this->assertJsonStringEqualsJsonString(json_encode($expectedResult), (string)$httpRequest->getBody());
    }
}
