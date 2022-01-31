<?php

namespace Commercetools\Core\Request;

use Commercetools\Core\Response\ResourceResponse;
use GuzzleHttp\Message\Response;
use Commercetools\Core\AccessorTrait;
use Commercetools\Core\Client\HttpMethod;

/**
 * Class AbstractHeadRequestTest
 * @package Commercetools\Core\Request
 * @method AbstractHeadRequest getRequest($class, array $args = [])
 */
class AbstractHeadRequestTest extends \PHPUnit\Framework\TestCase
{
    use AccessorTrait;

    const ABSTRACT_HEAD_REQUEST = AbstractHeadRequest::class;

    public function testHttpRequestMethod()
    {
        $request = $this->getRequest(static::ABSTRACT_HEAD_REQUEST);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::HEAD, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getRequest(static::ABSTRACT_HEAD_REQUEST);
        $httpRequest = $request->httpRequest();

        $this->assertSame('test', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getRequest(static::ABSTRACT_HEAD_REQUEST);
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();
        $request = $this->getRequest(static::ABSTRACT_HEAD_REQUEST);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(ResourceResponse::class, $response);
    }

    public function testWhere()
    {
        $request = $this->getRequest(static::ABSTRACT_HEAD_REQUEST);
        $request->where('test');
        $httpRequest = $request->httpRequest();

        $this->assertSame('test?where=test', (string)$httpRequest->getUri());
    }
}
