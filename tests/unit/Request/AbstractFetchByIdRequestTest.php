<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 10.02.15, 10:29
 */

namespace Sphere\Core\Request;


use GuzzleHttp\Message\Response;
use Sphere\Core\AccessorTrait;
use Sphere\Core\Client\HttpMethod;

/**
 * Class AbstractCreateRequestTest
 * @package Sphere\Core\Request
 * @method AbstractFetchByIdRequest getRequest($class, array $args = [])
 */
class AbstractFetchByIdRequestTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_FETCH_REQUEST = '\Sphere\Core\Request\AbstractFetchByIdRequest';

    public function testGetId()
    {
        $request = $this->getRequest(static::ABSTRACT_FETCH_REQUEST, ['']);
        $request->setId('id');
        $this->assertSame('id', $request->getId());
    }

    public function testHttpRequestMethod()
    {
        $request = $this->getRequest(static::ABSTRACT_FETCH_REQUEST, ['id']);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getHttpMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getRequest(static::ABSTRACT_FETCH_REQUEST, ['id']);
        $httpRequest = $request->httpRequest();

        $this->assertSame('test/id', $httpRequest->getPath());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getRequest(static::ABSTRACT_FETCH_REQUEST, ['id']);
        $httpRequest = $request->httpRequest();

        $this->assertNull($httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Message\Response', [], [], '', false);
        $request = $this->getRequest(static::ABSTRACT_FETCH_REQUEST, ['id']);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
    }
}
