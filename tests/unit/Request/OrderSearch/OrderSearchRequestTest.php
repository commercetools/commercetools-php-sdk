<?php

namespace Commercetools\Core\Request\Orders;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\Order\Hit;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\PagedSearchResponse;

class OrderSearchRequestTest extends RequestTestCase
{
    public function testMapResult()
    {
        /**
         * @var Hit $result
         */
        $result = $this->mapQueryResult(OrderSearchRequest::of());
        $this->assertInstanceOf(Hit::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(OrderSearchRequest::of());
        $this->assertInstanceOf(Hit::class, $result);
        $this->assertEmpty($result->toArray());
    }

    public function testHttpRequestMethod()
    {
        $request = OrderSearchRequest::of();
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = OrderSearchRequest::of();
        $httpRequest = $request->httpRequest();

        $this->assertSame('orders/search', (string)$httpRequest->getUri());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = OrderSearchRequest::of();
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(PagedSearchResponse::class, $response);
    }
}
