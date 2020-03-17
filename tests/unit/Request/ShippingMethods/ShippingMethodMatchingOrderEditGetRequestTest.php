<?php

namespace Commercetools\Core\Request\ShippingMethods;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\PagedQueryResponse;

class ShippingMethodMatchingOrderEditGetRequestTest extends RequestTestCase
{
    const SHIPPING_METHOD_MATCHING_ORDER_EDIT_GET_REQUEST =
        ShippingMethodMatchingOrderEditGetRequest::class;

    public function testMapResult()
    {
        $result = $this->mapResult(ShippingMethodMatchingOrderEditGetRequest::ofCountry('DE'));
        $this->assertInstanceOf(ShippingMethodCollection::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ShippingMethodMatchingOrderEditGetRequest::ofCountry('DE'));
        $this->assertNull($result);
    }

    public function testHttpRequestMethod()
    {
        $request = ShippingMethodMatchingOrderEditGetRequest::ofCountry('DE');
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = ShippingMethodMatchingOrderEditGetRequest::ofCountry('DE');
        $httpRequest = $request->httpRequest();

        $this->assertSame('shipping-methods/matching-orderedit?country=DE', (string)$httpRequest->getUri());
    }

    public function testHttpRequestPathWithState()
    {
        $request = ShippingMethodMatchingOrderEditGetRequest::ofCountry('DE')->withState('Berlin');
        $httpRequest = $request->httpRequest();

        $this->assertSame(
            'shipping-methods/matching-orderedit?country=DE&state=Berlin',
            (string)$httpRequest->getUri()
        );
    }

    public function testHttpRequestPathWithCurrency()
    {
        $request = ShippingMethodMatchingOrderEditGetRequest::ofCountry('DE');
        $httpRequest = $request->httpRequest();

        $this->assertSame('shipping-methods/matching-orderedit?country=DE', (string)$httpRequest->getUri());
    }

    public function testHttpRequestPathWithStateAndCurrency()
    {
        $request = ShippingMethodMatchingOrderEditGetRequest::ofCountry('DE')->withState('Berlin');
        $httpRequest = $request->httpRequest();

        $this->assertSame(
            'shipping-methods/matching-orderedit?country=DE&state=Berlin',
            (string)$httpRequest->getUri()
        );
    }

    public function testHttpRequestObject()
    {
        $request = ShippingMethodMatchingOrderEditGetRequest::ofCountry('DE');
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = ShippingMethodMatchingOrderEditGetRequest::ofCountry('DE');
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(PagedQueryResponse::class, $response);
    }
}
