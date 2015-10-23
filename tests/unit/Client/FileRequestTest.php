<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 10.02.15, 16:04
 */

namespace Commercetools\Core\Client;

class FileRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testGetFile()
    {
        $fileRequest = new FileRequest(HttpMethod::POST, 'test', 'file', 'application/pdf');
        $this->assertSame('file', $fileRequest->getFile());
    }

    public function testGetBody()
    {
        $fileRequest = new FileRequest(HttpMethod::POST, 'test', 'file', 'application/pdf');
        $this->assertEmpty((string)$fileRequest->getBody());
    }

    public function testContentType()
    {
        $fileRequest = new FileRequest(HttpMethod::POST, 'test', 'file', 'application/pdf');
        $this->assertSame(['Content-Type' => ['application/pdf']], $fileRequest->getHeaders());
    }
}
