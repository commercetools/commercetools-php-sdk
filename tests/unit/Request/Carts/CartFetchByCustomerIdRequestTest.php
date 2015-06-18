<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\RequestTestCase;

class CartFetchByCustomerIdRequestTest extends RequestTestCase
{
    const CART_FETCH_BY_CUSTOMER_ID_REQUEST = '\Sphere\Core\Request\Carts\CartFetchByCustomerIdRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(static::CART_FETCH_BY_CUSTOMER_ID_REQUEST, ['id']);
        $this->assertInstanceOf('\Sphere\Core\Model\Cart\Cart', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CART_FETCH_BY_CUSTOMER_ID_REQUEST, ['id']);
        $this->assertNull($result);
    }

    public function testHttpRequestMethod()
    {
        $request = $this->getRequest(static::CART_FETCH_BY_CUSTOMER_ID_REQUEST, ['id']);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getRequest(static::CART_FETCH_BY_CUSTOMER_ID_REQUEST, ['id']);
        $httpRequest = $request->httpRequest();

        $this->assertSame('/carts?customerId=id', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getRequest(static::CART_FETCH_BY_CUSTOMER_ID_REQUEST, ['id']);
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Psr7\Response', [], [], '', false);
        $request = $this->getRequest(static::CART_FETCH_BY_CUSTOMER_ID_REQUEST, ['id']);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
    }
}
