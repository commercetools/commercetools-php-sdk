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
 * @method AbstractProjectionRequest getRequest($class, array $args = [])
 */
class AbstractProjectionRequestTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_PROJECTION_REQUEST = '\Sphere\Core\Request\AbstractProjectionRequest';

    /**
     * @return AbstractProjectionRequest
     */
    protected function getProjectionRequest()
    {
        $request = $this->getRequest(static::ABSTRACT_PROJECTION_REQUEST);
        $request->expects($this->any())
            ->method('getProjectionAction')
            ->will($this->returnValue('action'));
        return $request;
    }

    public function testHttpRequestMethod()
    {
        $request = $this->getProjectionRequest();
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getHttpMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getProjectionRequest();
        $httpRequest = $request->httpRequest();

        $this->assertSame('test/action', $httpRequest->getPath());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getProjectionRequest();
        $httpRequest = $request->httpRequest();

        $this->assertNull($httpRequest->getBody());
    }

    public function testStagedTrue()
    {
        $request = $this->getProjectionRequest();
        $request->staged(true);
        $httpRequest = $request->httpRequest();

        $this->assertSame('test/action?staged=true', $httpRequest->getPath());
    }
}
