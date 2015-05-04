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
        $request = $this->getRequest(static::CUSTOMER_PASSWORD_REQUEST, ['customerId', 1, 'resetToken', 'newPW']);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getHttpMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getRequest(static::CUSTOMER_PASSWORD_REQUEST, ['customerId', 1, 'resetToken', 'newPW']);
        $httpRequest = $request->httpRequest();

        $this->assertSame('customers/password/reset', $httpRequest->getPath());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getRequest(static::CUSTOMER_PASSWORD_REQUEST, ['customerId', 1, 'resetToken', 'newPW']);
        $httpRequest = $request->httpRequest();

        $this->assertJsonStringEqualsJsonString(
            json_encode(
                ['id' => 'customerId', 'version' => 1, 'tokenValue' => 'resetToken', 'newPassword' => 'newPW']
            ),
            $httpRequest->getBody()
        );
    }
}
