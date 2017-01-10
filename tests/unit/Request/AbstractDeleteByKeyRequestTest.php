<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 10.02.15, 10:29
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\AccessorTrait;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Response\ResourceResponse;

/**
 * Class AbstractCreateRequestTest
 * @package Commercetools\Core\Request
 * @method AbstractDeleteByKeyRequest getRequest($class, array $args = [])
 */
class AbstractDeleteByKeyRequestTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_DELETE_REQUEST = AbstractDeleteByKeyRequest::class;

    public function testGetId()
    {
        $request = $this->getRequest(static::ABSTRACT_DELETE_REQUEST, ['', '']);
        $request->setKey('key');
        $this->assertSame('key', $request->getKey());
    }

    public function testGetVersion()
    {
        $request = $this->getRequest(static::ABSTRACT_DELETE_REQUEST, ['', '']);
        $request->setVersion('version');
        $this->assertSame('version', $request->getVersion());
    }


    public function testHttpRequestMethod()
    {
        $request = $this->getRequest(static::ABSTRACT_DELETE_REQUEST, ['key', 'version']);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::DELETE, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getRequest(static::ABSTRACT_DELETE_REQUEST, ['key', 'version']);
        $httpRequest = $request->httpRequest();

        $this->assertSame('test/key=key?version=version', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getRequest(static::ABSTRACT_DELETE_REQUEST, ['key', 'version']);
        $httpRequest = $request->httpRequest();

        $this->assertSame('test/key=key?version=version', (string)$httpRequest->getUri());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = $this->getRequest(static::ABSTRACT_DELETE_REQUEST, ['key', 'version']);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(ResourceResponse::class, $response);
    }
}
