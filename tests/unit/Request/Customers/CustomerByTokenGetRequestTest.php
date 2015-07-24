<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\RequestTestCase;

class CustomerByTokenGetRequestTest extends RequestTestCase
{
    const CUSTOMER_BY_TOKEN_GET_REQUEST = '\Sphere\Core\Request\Customers\CustomerByTokenGetRequest';

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

        $this->assertSame('customers?token=myToken', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = CustomerByTokenGetRequest::ofToken('myToken');
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Psr7\Response', [], [], '', false);
        $request = CustomerByTokenGetRequest::ofToken('myToken');
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
    }
}
