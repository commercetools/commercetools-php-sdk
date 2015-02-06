<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 29.01.15, 11:57
 */

namespace Sphere\Core\Client;

class JsonEndpointTest extends \PHPUnit_Framework_TestCase
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
