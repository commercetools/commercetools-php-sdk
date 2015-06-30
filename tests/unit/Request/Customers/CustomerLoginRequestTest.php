<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\RequestTestCase;

class CustomerLoginRequestTest extends RequestTestCase
{
    const CUSTOMER_LOGIN_REQUEST = '\Sphere\Core\Request\Customers\CustomerLoginRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(static::CUSTOMER_LOGIN_REQUEST, ['email', 'password']);
        $this->assertInstanceOf('\Sphere\Core\Model\Customer\CustomerSigninResult', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CUSTOMER_LOGIN_REQUEST, ['email', 'password']);
        $this->assertNull($result);
    }

    public function testHttpRequestMethod()
    {
        $request = $this->getRequest(static::CUSTOMER_LOGIN_REQUEST, ['email', 'password']);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getRequest(static::CUSTOMER_LOGIN_REQUEST, ['email', 'password']);
        $httpRequest = $request->httpRequest();

        $this->assertSame('login', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getRequest(static::CUSTOMER_LOGIN_REQUEST, ['email', 'password']);
        $httpRequest = $request->httpRequest();

        $this->assertJsonStringEqualsJsonString(
            json_encode(['email' => 'email', 'password' => 'password']),
            (string)$httpRequest->getBody()
        );
    }

    public function testHttpRequestObjectWithCart()
    {
        $request = $this->getRequest(static::CUSTOMER_LOGIN_REQUEST, ['email', 'password', 'cartId']);
        $httpRequest = $request->httpRequest();

        $this->assertJsonStringEqualsJsonString(
            json_encode(['email' => 'email', 'password' => 'password', 'anonymousCartId' => 'cartId']),
            (string)$httpRequest->getBody()
        );
    }


    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Psr7\Response', [], [], '', false);
        $request = $this->getRequest(static::CUSTOMER_LOGIN_REQUEST, ['email', 'password']);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
    }
}
