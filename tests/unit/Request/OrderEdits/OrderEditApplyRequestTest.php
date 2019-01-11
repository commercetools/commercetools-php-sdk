<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\OrderEdit\OrderEdit;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\ResourceResponse;

class OrderEditApplyRequestTest extends RequestTestCase
{
    public function testMapResult()
    {
        $result = $this->mapResult(OrderEditApplyRequest::ofIdVersionAndResourceVersion('1', 1, 1));
        $this->assertInstanceOf(OrderEdit::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(OrderEditApplyRequest::ofIdVersionAndResourceVersion('1', 1, 1));
        $this->assertNull($result);
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = OrderEditApplyRequest::ofIdVersionAndResourceVersion('1', 1, 1);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(ResourceResponse::class, $response);
    }

    public function testHttpRequestMethod()
    {
        $request = OrderEditApplyRequest::ofIdVersionAndResourceVersion('1', 1, 1);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = OrderEditApplyRequest::ofIdVersionAndResourceVersion('id-1', 1, 1);
        $httpRequest = $request->httpRequest();

        $this->assertSame('orders/edits/id-1/apply', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = OrderEditApplyRequest::ofIdVersionAndResourceVersion('id-1', 1, 2);
        $httpRequest = $request->httpRequest();

        $expectedResult = [
            'editVersion' => 1,
            'resourceVersion' => 2
        ];
        $this->assertJsonStringEqualsJsonString(json_encode($expectedResult), (string)$httpRequest->getBody());
    }
}
