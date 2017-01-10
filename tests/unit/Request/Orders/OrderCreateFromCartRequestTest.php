<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\RequestTestCase;

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

        $this->assertInstanceOf('\Commercetools\Core\Response\ResourceResponse', $response);
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
        $request->setOrderNumber('12345678')
            ->setPaymentState('paid');

        $httpRequest = $request->httpRequest();

        $expectedResult = [
            'id' => '12345',
            'version' => 1,
            'orderNumber' => '12345678',
            'paymentState' => 'paid'
        ];
        $this->assertJsonStringEqualsJsonString(json_encode($expectedResult), (string)$httpRequest->getBody());
    }
}
