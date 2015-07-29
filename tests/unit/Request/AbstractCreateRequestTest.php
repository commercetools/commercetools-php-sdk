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
 * @method AbstractCreateRequest getRequest($class, array $args = [])
 */
class AbstractCreateRequestTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_CREATE_REQUEST = '\Sphere\Core\Request\AbstractCreateRequest';

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
        $guzzleResponse = $this->getMock('\GuzzleHttp\Psr7\Response', [], [], '', false);
        $request = $this->getRequest(static::ABSTRACT_CREATE_REQUEST, [['key' => 'value']]);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\ResourceResponse', $response);
    }
}
