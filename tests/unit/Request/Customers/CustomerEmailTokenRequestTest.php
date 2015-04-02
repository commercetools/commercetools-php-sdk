<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\RequestTestCase;

/**
 * Class CustomerEmailTokenRequestTest
 * @package Sphere\Core\Request\Customers
 */
class CustomerEmailTokenRequestTest extends RequestTestCase
{
    const CUSTOMER_EMAIL_TOKEN_REQUEST = '\Sphere\Core\Request\Customers\CustomerEmailTokenRequest';

    public function testHttpRequestMethod()
    {
        $request = $this->getRequest(static::CUSTOMER_EMAIL_TOKEN_REQUEST, ['customerId', 1, 5]);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getHttpMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getRequest(static::CUSTOMER_EMAIL_TOKEN_REQUEST, ['customerId', 1, 5]);
        $httpRequest = $request->httpRequest();

        $this->assertSame('customers/email-token', $httpRequest->getPath());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getRequest(static::CUSTOMER_EMAIL_TOKEN_REQUEST, ['customerId', 1, 5]);
        $httpRequest = $request->httpRequest();

        $this->assertJsonStringEqualsJsonString(
            json_encode(['id' => 'customerId', 'version' => 1, 'ttlMinutes' => 5]),
            $httpRequest->getBody()
        );
    }
}
