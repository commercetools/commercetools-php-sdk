<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\PagedQueryResponse;

class ShippingMethodMatchingLocationGetRequestTest extends RequestTestCase
{
    const SHIPPING_METHOD_MATCHING_LOCATION_GET_REQUEST =
        ShippingMethodMatchingLocationGetRequest::class;

    public function testMapResult()
    {
        $result = $this->mapResult(ShippingMethodMatchingLocationGetRequest::ofCountry('DE'));
        $this->assertInstanceOf(ShippingMethodCollection::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ShippingMethodMatchingLocationGetRequest::ofCountry('DE'));
        $this->assertNull($result);
    }

    public function testHttpRequestMethod()
    {
        $request = ShippingMethodMatchingLocationGetRequest::ofCountry('DE');
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = ShippingMethodMatchingLocationGetRequest::ofCountry('DE');
        $httpRequest = $request->httpRequest();

        $this->assertSame('shipping-methods/matching-location?country=DE', (string)$httpRequest->getUri());
    }

    public function testHttpRequestPathWithState()
    {
        $request = ShippingMethodMatchingLocationGetRequest::ofCountry('DE')->withState('Berlin');
        $httpRequest = $request->httpRequest();

        $this->assertSame('shipping-methods/matching-location?country=DE&state=Berlin', (string)$httpRequest->getUri());
    }

    public function testHttpRequestPathWithCurrency()
    {
        $request = ShippingMethodMatchingLocationGetRequest::ofCountry('DE')->withCurrency('EUR');
        $httpRequest = $request->httpRequest();

        $this->assertSame('shipping-methods/matching-location?country=DE&currency=EUR', (string)$httpRequest->getUri());
    }

    public function testHttpRequestPathWithStateAndCurrency()
    {
        $request = ShippingMethodMatchingLocationGetRequest::ofCountry('DE')->withState('Berlin')->withCurrency('EUR');
        $httpRequest = $request->httpRequest();

        $this->assertSame(
            'shipping-methods/matching-location?country=DE&currency=EUR&state=Berlin',
            (string)$httpRequest->getUri()
        );
    }

    public function testHttpRequestObject()
    {
        $request = ShippingMethodMatchingLocationGetRequest::ofCountry('DE');
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = ShippingMethodMatchingLocationGetRequest::ofCountry('DE');
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(PagedQueryResponse::class, $response);
    }
}
