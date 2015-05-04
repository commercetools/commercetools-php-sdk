<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\RequestTestCase;

class CustomerFetchByTokenRequestTest extends RequestTestCase
{
    const CUSTOMER_FETCH_BY_TOKEN_REQUEST = '\Sphere\Core\Request\Customers\CustomerFetchByTokenRequest';

    public function testHttpRequestMethod()
    {
        $request = $this->getRequest(static::CUSTOMER_FETCH_BY_TOKEN_REQUEST, ['myToken']);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getHttpMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getRequest(static::CUSTOMER_FETCH_BY_TOKEN_REQUEST, ['myToken']);
        $httpRequest = $request->httpRequest();

        $this->assertSame('customers?token=myToken', $httpRequest->getPath());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getRequest(static::CUSTOMER_FETCH_BY_TOKEN_REQUEST, ['myToken']);
        $httpRequest = $request->httpRequest();

        $this->assertNull($httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Message\Response', [], [], '', false);
        $request = $this->getRequest(static::CUSTOMER_FETCH_BY_TOKEN_REQUEST, ['myToken']);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
    }
}
