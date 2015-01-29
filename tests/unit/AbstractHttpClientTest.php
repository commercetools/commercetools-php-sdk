<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 29.01.15, 14:56
 */

namespace Sphere\Core;


class AbstractHttpClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return AbstractHttpClient
     */
    protected function getClient()
    {
        return $this->getMockForAbstractClass('\Sphere\Core\AbstractHttpClient', [], '', false);
    }

    protected function getConfig()
    {
        return [
            Config::CLIENT_ID => 'id',
            Config::CLIENT_SECRET => 'secret',
            Config::OAUTH_URL => 'oauthUrl',
            Config::PROJECT => 'project',
            Config::API_URL => 'apiUrl'
        ];
    }

    public function testConfigArray()
    {
        $client = $this->getClient();

        $client->setConfig($this->getConfig());
        $this->assertInstanceOf('\Sphere\Core\Config', $client->getConfig());
    }

    public function testGetConfig()
    {
        $this->assertInstanceOf('\Sphere\Core\Config', $this->getClient()->getConfig());
    }

    public function testGetHttpClient()
    {
        $client = $this->getMockForAbstractClass('\Sphere\Core\AbstractHttpClient', [], '', false);
        $client->expects($this->once())
            ->method('getBaseUrl')
            ->will($this->returnValue('test'));
        /**
         * @var AbstractHttpClient $client
         */
        $httpClient = $client->getHttpClient();
        $this->assertInstanceOf('\GuzzleHttp\Client', $httpClient);
        $this->assertSame('test', $httpClient->getBaseUrl());
    }
}
