<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\RequestTestCase;

class CartByCustomerIdGetRequestTest extends RequestTestCase
{
    const CART_BY_CUSTOMER_ID_GET_REQUEST = '\Commercetools\Core\Request\Carts\CartByCustomerIdGetRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(CartByCustomerIdGetRequest::ofCustomerId('id'));
        $this->assertInstanceOf('\Commercetools\Core\Model\Cart\Cart', $result);
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
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = CartByCustomerIdGetRequest::ofCustomerId('id');
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Commercetools\Core\Response\ResourceResponse', $response);
    }
}
