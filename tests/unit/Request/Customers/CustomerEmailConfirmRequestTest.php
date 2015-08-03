<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
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
    const CUSTOMER_EMAIL_CONFIRM_REQUEST = '\Commercetools\Core\Request\Customers\CustomerEmailConfirmRequest';

    public function testHttpRequestMethod()
    {
        $request = CustomerEmailConfirmRequest::ofIdVersionAndToken('customerId', 1, 'token');
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = CustomerEmailConfirmRequest::ofIdVersionAndToken('customerId', 1, 'token');
        $httpRequest = $request->httpRequest();

        $this->assertSame('customers/email/confirm', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = CustomerEmailConfirmRequest::ofIdVersionAndToken('customerId', 1, 'token');
        $httpRequest = $request->httpRequest();

        $this->assertJsonStringEqualsJsonString(
            json_encode(['id' => 'customerId', 'version' => 1, 'tokenValue' => 'token']),
            (string)$httpRequest->getBody()
        );
    }
}
