<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\RequestTestCase;

/**
 * Class CustomerEmailConfirmRequestTest
 * @package Sphere\Core\Request\Customers
 */
class CustomerEmailConfirmRequestTest extends RequestTestCase
{
    const CUSTOMER_EMAIL_CONFIRM_REQUEST = '\Sphere\Core\Request\Customers\CustomerEmailConfirmRequest';

    public function testHttpRequestMethod()
    {
        $request = $this->getRequest(static::CUSTOMER_EMAIL_CONFIRM_REQUEST, ['customerId', 1, 'token']);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getRequest(static::CUSTOMER_EMAIL_CONFIRM_REQUEST, ['customerId', 1, 'token']);
        $httpRequest = $request->httpRequest();

        $this->assertSame('/customers/email/confirm', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getRequest(static::CUSTOMER_EMAIL_CONFIRM_REQUEST, ['customerId', 1, 'token']);
        $httpRequest = $request->httpRequest();

        $this->assertJsonStringEqualsJsonString(
            json_encode(['id' => 'customerId', 'version' => 1, 'tokenValue' => 'token']),
            (string)$httpRequest->getBody()
        );
    }
}
