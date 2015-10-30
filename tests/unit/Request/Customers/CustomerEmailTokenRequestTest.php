<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\RequestTestCase;

/**
 * Class CustomerEmailTokenRequestTest
 * @package Commercetools\Core\Request\Customers
 */
class CustomerEmailTokenRequestTest extends RequestTestCase
{
    const CUSTOMER_EMAIL_TOKEN_REQUEST = '\Commercetools\Core\Request\Customers\CustomerEmailTokenRequest';

    public function testHttpRequestMethod()
    {
        $request = CustomerEmailTokenRequest::ofIdVersionAndTtl('customerId', 1, 5);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = CustomerEmailTokenRequest::ofIdVersionAndTtl('customerId', 1, 5);
        $httpRequest = $request->httpRequest();

        $this->assertSame('customers/email-token', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = CustomerEmailTokenRequest::ofIdVersionAndTtl('customerId', 1, 5);
        $httpRequest = $request->httpRequest();

        $this->assertJsonStringEqualsJsonString(
            json_encode(['id' => 'customerId', 'version' => 1, 'ttlMinutes' => 5]),
            (string)$httpRequest->getBody()
        );
    }
}
