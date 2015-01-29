<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 29.01.15, 10:51
 */

namespace Http;


use Sphere\Core\Http\HttpMethod;
use Sphere\Core\Http\HttpRequest;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function testPath()
    {
        $this->assertSame('test', $this->getRequest()->getPath());
    }

    public function testMethod()
    {
        $this->assertSame('get', $this->getRequest()->getHttpMethod());
    }

    public function testBody()
    {
        $this->assertEmpty($this->getRequest()->getBody());
    }

    public function testContentType()
    {
        $this->assertArrayHasKey('Content-Type', $this->getRequest()->getHeaders());
        $this->assertSame('application/json', $this->getRequest()->getHeaders()['Content-Type']);
    }

    /**
     * @return HttpRequest
     */
    protected function getRequest()
    {
        return new HttpRequest(HttpMethod::GET, 'test');
    }
}
