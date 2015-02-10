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
 * @method AbstractDeleteByIdRequest getRequest($class, array $args = [])
 */
class AbstractDeleteByIdRequestTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_DELETE_REQUEST = '\Sphere\Core\Request\AbstractDeleteByIdRequest';

    public function testGetId()
    {
        $request = $this->getRequest(static::ABSTRACT_DELETE_REQUEST, ['', '']);
        $request->setId('id');
        $this->assertSame('id', $request->getId());
    }

    public function testGetVersion()
    {
        $request = $this->getRequest(static::ABSTRACT_DELETE_REQUEST, ['', '']);
        $request->setVersion('version');
        $this->assertSame('version', $request->getVersion());
    }


    public function testHttpRequestMethod()
    {
        $request = $this->getRequest(static::ABSTRACT_DELETE_REQUEST, ['id', 'version']);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::DELETE, $httpRequest->getHttpMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getRequest(static::ABSTRACT_DELETE_REQUEST, ['id', 'version']);
        $httpRequest = $request->httpRequest();

        $this->assertSame('test/id', $httpRequest->getPath());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getRequest(static::ABSTRACT_DELETE_REQUEST, ['id', 'version']);
        $httpRequest = $request->httpRequest();

        $this->assertSame('{"version":"version"}', $httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Message\Response', [], [], '', false);
        $request = $this->getRequest(static::ABSTRACT_DELETE_REQUEST, ['id', 'version']);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
    }
}
