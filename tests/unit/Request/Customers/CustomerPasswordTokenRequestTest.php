<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\ResourceResponse;

class CustomerPasswordTokenRequestTest extends RequestTestCase
{
    const CUSTOMER_PASSWORD_REQUEST = CustomerPasswordTokenRequest::class;

    public function testHttpRequestMethod()
    {
        $request = CustomerPasswordTokenRequest::ofEmail('john.doe@company.com');
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = CustomerPasswordTokenRequest::ofEmail('john.doe@company.com');
        $httpRequest = $request->httpRequest();

        $this->assertSame('customers/password-token', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = CustomerPasswordTokenRequest::ofEmail('john.doe@company.com');
        $httpRequest = $request->httpRequest();

        $this->assertJsonStringEqualsJsonString(
            json_encode(
                ['email' => 'john.doe@company.com']
            ),
            (string)$httpRequest->getBody()
        );
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = CustomerPasswordTokenRequest::ofEmail('john.doe@company.com');
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(ResourceResponse::class, $response);
    }
}
