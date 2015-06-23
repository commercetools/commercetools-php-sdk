<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\RequestTestCase;

/**
 * Class CustomerPasswordResetRequestTest
 * @package Sphere\Core\Request\Customers
 */
class CustomerPasswordResetRequestTest extends RequestTestCase
{
    const CUSTOMER_PASSWORD_REQUEST = '\Sphere\Core\Request\Customers\CustomerPasswordResetRequest';

    public function testHttpRequestMethod()
    {
        $request = CustomerPasswordResetRequest::ofIdVersionTokenAndPassword('customerId', 1, 'resetToken', 'newPW');
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = CustomerPasswordResetRequest::ofIdVersionTokenAndPassword('customerId', 1, 'resetToken', 'newPW');
        $httpRequest = $request->httpRequest();

        $this->assertSame('/customers/password/reset', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = CustomerPasswordResetRequest::ofIdVersionTokenAndPassword('customerId', 1, 'resetToken', 'newPW');
        $httpRequest = $request->httpRequest();

        $this->assertJsonStringEqualsJsonString(
            json_encode(
                ['id' => 'customerId', 'version' => 1, 'tokenValue' => 'resetToken', 'newPassword' => 'newPW']
            ),
            (string)$httpRequest->getBody()
        );
    }
}
