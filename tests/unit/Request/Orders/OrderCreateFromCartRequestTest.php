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
        $result = $this->mapResult(static::ORDER_CREATE_REQUEST, ['12345', 1]);
        $this->assertInstanceOf('\Sphere\Core\Model\Order\Order', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::ORDER_CREATE_REQUEST, ['12345', 1]);
        $this->assertNull($result);
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Message\Response', [], [], '', false);
        $request = $this->getRequest(static::ORDER_CREATE_REQUEST, ['12345', 1]);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
    }

    public function testHttpRequestMethod()
    {
        $request = $this->getRequest(static::ORDER_CREATE_REQUEST, ['12345', 1]);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getHttpMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getRequest(static::ORDER_CREATE_REQUEST, ['12345', 1]);
        $httpRequest = $request->httpRequest();

        $this->assertSame('orders', $httpRequest->getPath());
    }

    public function testHttpRequestObject()
    {
        /**
         * @var OrderCreateFromCartRequest $request
         */
        $request = $this->getRequest(static::ORDER_CREATE_REQUEST, ['12345', 1]);
        $request->setOrderNumber('12345678')
            ->setPaymentState('paid');

        $httpRequest = $request->httpRequest();

        $expectedResult = [
            'id' => '12345',
            'version' => 1,
            'orderNumber' => '12345678',
            'paymentState' => 'paid'
        ];
        $this->assertJsonStringEqualsJsonString(json_encode($expectedResult), $httpRequest->getBody());
    }
}
