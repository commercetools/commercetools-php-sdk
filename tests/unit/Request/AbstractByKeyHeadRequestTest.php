<?php

namespace Commercetools\Core\Request;

use Commercetools\Core\AccessorTrait;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Response\ResourceResponse;

/**
 * Class AbstractCreateRequestTest
 * @package Commercetools\Core\Request
 * @method AbstractByKeyGetRequest getRequest($class, array $args = [])
 */
class AbstractByKeyHeadRequestTest extends \PHPUnit\Framework\TestCase
{
    use AccessorTrait;

    const ABSTRACT_HEAD_REQUEST = AbstractByKeyHeadRequest::class;

    public function testGetKey()
    {
        $request = $this->getRequest(static::ABSTRACT_HEAD_REQUEST, ['']);
        $request->setKey('key');
        $this->assertSame('key', $request->getKey());
    }

    public function testHttpRequestMethod()
    {
        $request = $this->getRequest(static::ABSTRACT_HEAD_REQUEST, ['key']);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::HEAD, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getRequest(static::ABSTRACT_HEAD_REQUEST, ['key']);
        $httpRequest = $request->httpRequest();

        $this->assertSame('test/key=key', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getRequest(static::ABSTRACT_HEAD_REQUEST, ['key']);
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = $this->getRequest(static::ABSTRACT_HEAD_REQUEST, ['key']);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(ResourceResponse::class, $response);
    }
}
