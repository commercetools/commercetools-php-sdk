<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 10.02.15, 10:29
 */

namespace Commercetools\Core\Request;

use GuzzleHttp\Message\Response;
use Commercetools\Core\AccessorTrait;
use Commercetools\Core\Client\HttpMethod;

/**
 * Class AbstractCreateRequestTest
 * @package Commercetools\Core\Request
 * @method AbstractProjectionRequest getRequest($class, array $args = [])
 */
class AbstractProjectionRequestTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_PROJECTION_REQUEST = '\Commercetools\Core\Request\AbstractProjectionRequest';

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

        $this->assertSame(HttpMethod::GET, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getProjectionRequest();
        $httpRequest = $request->httpRequest();

        $this->assertSame('test/action', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getProjectionRequest();
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testStagedTrue()
    {
        $request = $this->getProjectionRequest();
        $request->staged(true);
        $httpRequest = $request->httpRequest();

        $this->assertSame('test/action?staged=true', (string)$httpRequest->getUri());
    }
}
