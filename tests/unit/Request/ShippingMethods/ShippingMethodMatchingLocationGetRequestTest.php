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
        ShippingMethodByMatchingLocationGetRequest::class;

    public function testMapResult()
    {
        $result = $this->mapResult(ShippingMethodByMatchingLocationGetRequest::ofCountry('DE'));
        $this->assertInstanceOf(ShippingMethodCollection::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ShippingMethodByMatchingLocationGetRequest::ofCountry('DE'));
        $this->assertInstanceOf(ShippingMethodCollection::class, $result);
    }

    public function testHttpRequestMethod()
    {
        $request = ShippingMethodByMatchingLocationGetRequest::ofCountry('DE');
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = ShippingMethodByMatchingLocationGetRequest::ofCountry('DE');
        $httpRequest = $request->httpRequest();

        $this->assertSame('shipping-methods/matching-location?country=DE', (string)$httpRequest->getUri());
    }

    public function testHttpRequestPathWithState()
    {
        $request = ShippingMethodByMatchingLocationGetRequest::ofCountry('DE')->withState('Berlin');
        $httpRequest = $request->httpRequest();

        $this->assertSame('shipping-methods/matching-location?country=DE&state=Berlin', (string)$httpRequest->getUri());
    }

    public function testHttpRequestPathWithCurrency()
    {
        $request = ShippingMethodByMatchingLocationGetRequest::ofCountry('DE')->withCurrency('EUR');
        $httpRequest = $request->httpRequest();

        $this->assertSame('shipping-methods/matching-location?country=DE&currency=EUR', (string)$httpRequest->getUri());
    }

    public function testHttpRequestPathWithStateAndCurrency()
    {
        $request = ShippingMethodByMatchingLocationGetRequest::ofCountry('DE')->withState('Berlin')->withCurrency('EUR');
        $httpRequest = $request->httpRequest();

        $this->assertSame(
            'shipping-methods/matching-location?country=DE&currency=EUR&state=Berlin',
            (string)$httpRequest->getUri()
        );
    }

    public function testHttpRequestObject()
    {
        $request = ShippingMethodByMatchingLocationGetRequest::ofCountry('DE');
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = ShippingMethodByMatchingLocationGetRequest::ofCountry('DE');
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(PagedQueryResponse::class, $response);
    }
}
