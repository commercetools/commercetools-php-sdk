<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 29.01.15, 11:57
 */

namespace Commercetools\Core\Client;

class JsonEndpointTest extends \PHPUnit\Framework\TestCase
{
    public function testEndpoint()
    {
        $endpoint = new JsonEndpoint('test');
        $this->assertSame('test', $endpoint->endpoint());
    }

    public function testToString()
    {
        $endpoint = new JsonEndpoint('test');
        $this->assertSame('test', (string)$endpoint);
    }
}
