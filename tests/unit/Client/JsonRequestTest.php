<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 29.01.15, 11:00
 */

namespace Sphere\Core\Client;

class JsonRequestTest extends \PHPUnit_Framework_TestCase
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
        $this->assertSame('{"key":"value"}', $this->getRequest()->getBody());
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
        return new JsonRequest(HttpMethod::GET, 'test', ['key' => 'value']);
    }
}
