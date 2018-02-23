<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\RequestTestCase;

/**
 * Class CustomerPasswordChangeRequestTest
 * @package Commercetools\Core\Request\Customers
 */
class CustomerPasswordChangeRequestTest extends RequestTestCase
{
    const CUSTOMER_PASSWORD_REQUEST = CustomerPasswordChangeRequest::class;

    public function testHttpRequestMethod()
    {
        $request = CustomerPasswordChangeRequest::ofIdVersionAndPasswords('customerId', 1, 'currentPW', 'newPW');
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = CustomerPasswordChangeRequest::ofIdVersionAndPasswords('customerId', 1, 'currentPW', 'newPW');
        $httpRequest = $request->httpRequest();

        $this->assertSame('customers/password', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = CustomerPasswordChangeRequest::ofIdVersionAndPasswords('customerId', 1, 'currentPW', 'newPW');
        $httpRequest = $request->httpRequest();

        $this->assertJsonStringEqualsJsonString(
            json_encode(
                ['id' => 'customerId', 'version' => 1, 'currentPassword' => 'currentPW', 'newPassword' => 'newPW']
            ),
            (string)$httpRequest->getBody()
        );
    }
}
