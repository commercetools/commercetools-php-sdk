<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\RequestTestCase;

/**
 * Class CustomerPasswordChangeRequestTest
 * @package Sphere\Core\Request\Customers
 */
class CustomerPasswordChangeRequestTest extends RequestTestCase
{
    const CUSTOMER_PASSWORD_REQUEST = '\Sphere\Core\Request\Customers\CustomerPasswordChangeRequest';

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
