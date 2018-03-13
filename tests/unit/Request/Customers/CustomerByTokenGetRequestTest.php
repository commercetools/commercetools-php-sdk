<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\ResourceResponse;

class CustomerByTokenGetRequestTest extends RequestTestCase
{
    const CUSTOMER_BY_TOKEN_GET_REQUEST = CustomerByTokenGetRequest::class;

    public function testHttpRequestMethod()
    {
        $request = CustomerByTokenGetRequest::ofToken('myToken');
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = CustomerByTokenGetRequest::ofToken('myToken');
        $httpRequest = $request->httpRequest();

        $this->assertSame('customers/password-token=myToken', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = CustomerByTokenGetRequest::ofToken('myToken');
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = CustomerByTokenGetRequest::ofToken('myToken');
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(ResourceResponse::class, $response);
    }
}
