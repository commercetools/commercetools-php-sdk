<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\RequestTestCase;

class CartByCustomerIdGetRequestTest extends RequestTestCase
{
    const CART_BY_CUSTOMER_ID_GET_REQUEST = '\Sphere\Core\Request\Carts\CartByCustomerIdGetRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(CartByCustomerIdGetRequest::ofCustomerId('id'));
        $this->assertInstanceOf('\Sphere\Core\Model\Cart\Cart', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(CartByCustomerIdGetRequest::ofCustomerId('id'));
        $this->assertNull($result);
    }

    public function testHttpRequestMethod()
    {
        $request = CartByCustomerIdGetRequest::ofCustomerId('id');
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = CartByCustomerIdGetRequest::ofCustomerId('id');
        $httpRequest = $request->httpRequest();

        $this->assertSame('carts?customerId=id', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = CartByCustomerIdGetRequest::ofCustomerId('id');
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Psr7\Response', [], [], '', false);
        $request = CartByCustomerIdGetRequest::ofCustomerId('id');
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\ResourceResponse', $response);
    }
}
