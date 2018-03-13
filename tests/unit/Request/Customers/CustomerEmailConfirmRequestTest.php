<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\RequestTestCase;

/**
 * Class CustomerEmailConfirmRequestTest
 * @package Commercetools\Core\Request\Customers
 */
class CustomerEmailConfirmRequestTest extends RequestTestCase
{
    const CUSTOMER_EMAIL_CONFIRM_REQUEST = CustomerEmailConfirmRequest::class;

    public function testHttpRequestMethod()
    {
        $request = CustomerEmailConfirmRequest::ofToken('token');
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = CustomerEmailConfirmRequest::ofToken('token');
        $httpRequest = $request->httpRequest();

        $this->assertSame('customers/email/confirm', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = CustomerEmailConfirmRequest::ofToken('token');
        $httpRequest = $request->httpRequest();

        $this->assertJsonStringEqualsJsonString(
            json_encode(['tokenValue' => 'token']),
            (string)$httpRequest->getBody()
        );
    }
}
