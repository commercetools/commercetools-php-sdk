<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers;


use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\RequestTestCase;

/**
 * Class CustomerPasswordResetRequestTest
 * @package Commercetools\Core\Request\Customers
 */
class CustomerPasswordResetRequestTest extends RequestTestCase
{
    const CUSTOMER_PASSWORD_REQUEST = '\Commercetools\Core\Request\Customers\CustomerPasswordResetRequest';

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

        $this->assertSame('customers/password/reset', (string)$httpRequest->getUri());
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
