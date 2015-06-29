<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\RequestTestCase;

/**
 * Class OrderCreateFromCartRequestTest
 * @package Sphere\Core\Request\Orders
 */
class OrderCreateFromCartRequestTest extends RequestTestCase
{
    const ORDER_CREATE_REQUEST = '\Sphere\Core\Request\Orders\OrderCreateFromCartRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(OrderCreateFromCartRequest::ofCartIdAndVersion('12345', 1));
        $this->assertInstanceOf('\Sphere\Core\Model\Order\Order', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(OrderCreateFromCartRequest::ofCartIdAndVersion('12345', 1));
        $this->assertNull($result);
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Psr7\Response', [], [], '', false);
        $request = OrderCreateFromCartRequest::ofCartIdAndVersion('12345', 1);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
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

        $this->assertSame('/orders', (string)$httpRequest->getUri());
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
