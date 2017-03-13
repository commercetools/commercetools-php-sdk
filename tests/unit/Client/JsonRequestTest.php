<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 29.01.15, 11:00
 */

namespace Commercetools\Core\Client;

class JsonRequestTest extends \PHPUnit\Framework\TestCase
{
    public function testPath()
    {
        $this->assertSame('test', (string)$this->getRequest()->getUri());
    }

    public function testMethod()
    {
        $this->assertSame(HttpMethod::GET, $this->getRequest()->getMethod());
    }

    public function testBody()
    {
        $this->assertSame('{"key":"value"}', (string)$this->getRequest()->getBody());
    }

    public function testContentType()
    {
        $this->assertArrayHasKey('Content-Type', $this->getRequest()->getHeaders());
        $this->assertSame('application/json', $this->getRequest()->getHeader('Content-Type')[0]);
    }

    /**
     * @return HttpRequest
     */
    protected function getRequest()
    {
        return new JsonRequest(HttpMethod::GET, 'test', ['key' => 'value']);
    }
}
