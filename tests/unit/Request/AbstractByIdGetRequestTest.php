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
 * @method AbstractByIdGetRequest getRequest($class, array $args = [])
 */
class AbstractByIdGetRequestTest extends \PHPUnit\Framework\TestCase
{
    use AccessorTrait;

    const ABSTRACT_GET_REQUEST = AbstractByIdGetRequest::class;

    public function testGetId()
    {
        $request = $this->getRequest(static::ABSTRACT_GET_REQUEST, ['']);
        $request->setId('id');
        $this->assertSame('id', $request->getId());
    }

    public function testHttpRequestMethod()
    {
        $request = $this->getRequest(static::ABSTRACT_GET_REQUEST, ['id']);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getRequest(static::ABSTRACT_GET_REQUEST, ['id']);
        $httpRequest = $request->httpRequest();

        $this->assertSame('test/id', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getRequest(static::ABSTRACT_GET_REQUEST, ['id']);
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();
        $request = $this->getRequest(static::ABSTRACT_GET_REQUEST, ['id']);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(ResourceResponse::class, $response);
    }
}
