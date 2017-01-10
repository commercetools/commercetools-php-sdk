<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\Customer\CustomerSigninResult;
use Commercetools\Core\RequestTestCase;

class CustomerLoginRequestTest extends RequestTestCase
{
    const CUSTOMER_LOGIN_REQUEST = CustomerLoginRequest::class;

    public function testMapResult()
    {
        $result = $this->mapResult(CustomerLoginRequest::ofEmailAndPassword('email', 'password'));
        $this->assertInstanceOf(CustomerSigninResult::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(CustomerLoginRequest::ofEmailAndPassword('email', 'password'));
        $this->assertNull($result);
    }

    public function testHttpRequestMethod()
    {
        $request = CustomerLoginRequest::ofEmailAndPassword('email', 'password');
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = CustomerLoginRequest::ofEmailAndPassword('email', 'password');
        $httpRequest = $request->httpRequest();

        $this->assertSame('login', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = CustomerLoginRequest::ofEmailAndPassword('email', 'password');
        $httpRequest = $request->httpRequest();

        $this->assertJsonStringEqualsJsonString(
            json_encode(['email' => 'email', 'password' => 'password']),
            (string)$httpRequest->getBody()
        );
    }

    public function testHttpRequestObjectWithCart()
    {
        $request = CustomerLoginRequest::ofEmailAndPassword('email', 'password', 'cartId');
        $httpRequest = $request->httpRequest();

        $this->assertJsonStringEqualsJsonString(
            json_encode(['email' => 'email', 'password' => 'password', 'anonymousCartId' => 'cartId']),
            (string)$httpRequest->getBody()
        );
    }


    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = CustomerLoginRequest::ofEmailAndPassword('email', 'password');
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Commercetools\Core\Response\ResourceResponse', $response);
    }
}
