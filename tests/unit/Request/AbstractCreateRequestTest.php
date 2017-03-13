<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 10.02.15, 10:29
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Response\ResourceResponse;
use GuzzleHttp\Message\Response;
use Commercetools\Core\AccessorTrait;
use Commercetools\Core\Client\HttpMethod;

/**
 * Class AbstractCreateRequestTest
 * @package Commercetools\Core\Request
 * @method AbstractCreateRequest getRequest($class, array $args = [])
 */
class AbstractCreateRequestTest extends \PHPUnit\Framework\TestCase
{
    use AccessorTrait;

    const ABSTRACT_CREATE_REQUEST = AbstractCreateRequest::class;

    public function testHttpRequestMethod()
    {
        $request = $this->getRequest(static::ABSTRACT_CREATE_REQUEST, [['key' => 'value']]);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getRequest(static::ABSTRACT_CREATE_REQUEST, [['key' => 'value']]);
        $httpRequest = $request->httpRequest();

        $this->assertSame('test', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getRequest(static::ABSTRACT_CREATE_REQUEST, [['key' => 'value']]);
        $httpRequest = $request->httpRequest();

        $this->assertSame('{"key":"value"}', (string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = $this->getRequest(static::ABSTRACT_CREATE_REQUEST, [['key' => 'value']]);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(ResourceResponse::class, $response);
    }
}
