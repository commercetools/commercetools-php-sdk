<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\ResourceResponse;

class ShippingMethodByCartIdGetRequestTest extends RequestTestCase
{
    const SHIPPING_METHOD_BY_CART_ID_GET_REQUEST =
        ShippingMethodByCartIdGetRequest::class;

    public function testMapResult()
    {
        $result = $this->mapResult(ShippingMethodByCartIdGetRequest::ofCartId('id'));
        $this->assertInstanceOf(ShippingMethodCollection::class, $result);
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

        $this->assertInstanceOf(ResourceResponse::class, $response);
    }
}
