<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\RequestTestCase;

class CustomerPasswordTokenRequestTest extends RequestTestCase
{
    const CUSTOMER_PASSWORD_REQUEST = '\Sphere\Core\Request\Customers\CustomerPasswordTokenRequest';

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
        $guzzleResponse = $this->getMock('\GuzzleHttp\Psr7\Response', [], [], '', false);
        $request = CustomerPasswordTokenRequest::ofEmail('john.doe@company.com');
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
    }
}
