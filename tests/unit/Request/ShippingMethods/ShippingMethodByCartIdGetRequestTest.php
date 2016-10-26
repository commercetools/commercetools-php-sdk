<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\RequestTestCase;

class ShippingMethodByCartIdGetRequestTest extends RequestTestCase
{
    const SHIPPING_METHOD_BY_CART_ID_GET_REQUEST =
        '\Commercetools\Core\Request\Carts\ShippingMethodByCartIdGetRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(ShippingMethodByCartIdGetRequest::ofCartId('id'));
        $this->assertInstanceOf('\Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ShippingMethodByCartIdGetRequest::ofCartId('id'));
        $this->assertNull($result);
    }

    public function testHttpRequestMethod()
    {
        $request = ShippingMethodByCartIdGetRequest::ofCartId('id');
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = ShippingMethodByCartIdGetRequest::ofCartId('id');
        $httpRequest = $request->httpRequest();

        $this->assertSame('shipping-methods?cartId=id', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = ShippingMethodByCartIdGetRequest::ofCartId('id');
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = ShippingMethodByCartIdGetRequest::ofCartId('id');
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Commercetools\Core\Response\ResourceResponse', $response);
    }
}
