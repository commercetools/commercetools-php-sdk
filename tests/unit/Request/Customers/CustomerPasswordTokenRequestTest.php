<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\RequestTestCase;

class CustomerPasswordTokenRequestTest extends RequestTestCase
{
    const CUSTOMER_PASSWORD_REQUEST = '\Commercetools\Core\Request\Customers\CustomerPasswordTokenRequest';

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

        $this->assertInstanceOf('\Commercetools\Core\Response\ResourceResponse', $response);
    }
}
