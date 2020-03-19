<?php

namespace Commercetools\Core\Request\ShippingMethods;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\PagedQueryResponse;

class ShippingMethodMatchingOrderEditGetRequestTest extends RequestTestCase
{
    const SHIPPING_METHOD_MATCHING_ORDER_EDIT_GET_REQUEST =
        ShippingMethodByMatchingOrderEditGetRequest::class;

    public function testMapResult()
    {
        $result = $this->mapResult(
            ShippingMethodByMatchingOrderEditGetRequest::ofOrderEditAndCountry('OrderEditId', 'DE')
        );
        $this->assertInstanceOf(ShippingMethodCollection::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(
            ShippingMethodByMatchingOrderEditGetRequest::ofOrderEditAndCountry('OrderEditId', 'DE')
        );
        $this->assertInstanceOf(ShippingMethodCollection::class, $result);
    }

    public function testHttpRequestMethod()
    {
        $request = ShippingMethodByMatchingOrderEditGetRequest::ofOrderEditAndCountry('OrderEditId', 'DE');
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = ShippingMethodByMatchingOrderEditGetRequest::ofOrderEditAndCountry('OrderEditId', 'DE');
        $httpRequest = $request->httpRequest();

        $this->assertSame(
            'shipping-methods/matching-orderedit?country=DE&orderEditId=OrderEditId',
            (string)$httpRequest->getUri()
        );
    }

    public function testHttpRequestPathWithState()
    {
        $request = ShippingMethodByMatchingOrderEditGetRequest::ofOrderEditAndCountry('OrderEditId', 'DE')
            ->withState('Berlin');
        $httpRequest = $request->httpRequest();

        $this->assertSame(
            'shipping-methods/matching-orderedit?country=DE&orderEditId=OrderEditId&state=Berlin',
            (string)$httpRequest->getUri()
        );
    }

    public function testHttpRequestObject()
    {
        $request = ShippingMethodByMatchingOrderEditGetRequest::ofOrderEditAndCountry('OrderEditId', 'DE');
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = ShippingMethodByMatchingOrderEditGetRequest::ofOrderEditAndCountry('OrderEditId', 'DE');
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(PagedQueryResponse::class, $response);
    }
}
