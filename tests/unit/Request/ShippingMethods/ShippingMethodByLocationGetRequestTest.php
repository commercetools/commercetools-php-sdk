<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\ResourceResponse;

class ShippingMethodByLocationGetRequestTest extends RequestTestCase
{
    const SHIPPING_METHOD_BY_LOCATION_GET_REQUEST =
        ShippingMethodByLocationGetRequest::class;

    public function testMapResult()
    {
        $result = $this->mapResult(ShippingMethodByLocationGetRequest::ofCountry('DE'));
        $this->assertInstanceOf(ShippingMethodCollection::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ShippingMethodByLocationGetRequest::ofCountry('DE'));
        $this->assertNull($result);
    }

    public function testHttpRequestMethod()
    {
        $request = ShippingMethodByLocationGetRequest::ofCountry('DE');
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = ShippingMethodByLocationGetRequest::ofCountry('DE');
        $httpRequest = $request->httpRequest();

        $this->assertSame('shipping-methods?country=DE', (string)$httpRequest->getUri());
    }

    public function testHttpRequestPathWithState()
    {
        $request = ShippingMethodByLocationGetRequest::ofCountry('DE')->withState('Berlin');
        $httpRequest = $request->httpRequest();

        $this->assertSame('shipping-methods?country=DE&state=Berlin', (string)$httpRequest->getUri());
    }

    public function testHttpRequestPathWithCurrency()
    {
        $request = ShippingMethodByLocationGetRequest::ofCountry('DE')->withCurrency('EUR');
        $httpRequest = $request->httpRequest();

        $this->assertSame('shipping-methods?country=DE&currency=EUR', (string)$httpRequest->getUri());
    }

    public function testHttpRequestPathWithStateAndCurrency()
    {
        $request = ShippingMethodByLocationGetRequest::ofCountry('DE')->withState('Berlin')->withCurrency('EUR');
        $httpRequest = $request->httpRequest();

        $this->assertSame('shipping-methods?country=DE&currency=EUR&state=Berlin', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = ShippingMethodByLocationGetRequest::ofCountry('DE');
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = ShippingMethodByLocationGetRequest::ofCountry('DE');
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(ResourceResponse::class, $response);
    }
}
