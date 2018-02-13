<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 29.01.15, 14:56
 */

namespace Commercetools\Core;

use Commercetools\Core\Client\Adapter\AdapterInterface;

class AbstractHttpClientTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return AbstractHttpClient
     */
    protected function getClient()
    {
        return $this->getMockForAbstractClass(AbstractHttpClient::class, [], '', false);
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
        $this->assertInstanceOf(Config::class, $client->getConfig());
    }

    public function testGetConfig()
    {
        $this->assertInstanceOf(Config::class, $this->getClient()->getConfig());
    }

    public function testSetConfig()
    {
        $config = $this->getConfig();
        $this->assertInstanceOf(AbstractHttpClient::class, $this->getClient()->setConfig($config));
        $this->assertInstanceOf(Config::class, $this->getClient()->getConfig());
    }

    public function testGetHttpClient()
    {
        $client = $this->getMockForAbstractClass(AbstractHttpClient::class, [], '', false);
        $client->expects($this->once())
            ->method('getBaseUrl')
            ->will($this->returnValue('test'));
        /**
         * @var AbstractHttpClient $client
         */
        $httpClient = $client->getHttpClient();
        $this->assertInstanceOf(AdapterInterface::class, $httpClient);
        //$this->assertSame('/test', (string)$httpClient->getConfig('base_uri'));
    }
}
