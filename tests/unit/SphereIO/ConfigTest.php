<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 22.01.15, 10:30
 */

namespace SphereIO;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
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

    public function testFromArray()
    {
        $testConfig = $this->getConfig();
        $config = new Config();
        $this->assertInstanceOf('\SphereIO\Config', $config->fromArray($testConfig));

        $this->assertEquals($testConfig[Config::CLIENT_ID], $config->getClientId());
        $this->assertEquals($testConfig[Config::CLIENT_SECRET], $config->getClientSecret());
        $this->assertEquals($testConfig[Config::OAUTH_URL], $config->getOauthUrl());
        $this->assertEquals($testConfig[Config::PROJECT], $config->getProject());
        $this->assertEquals($testConfig[Config::API_URL], $config->getApiUrl());
    }

    public function testEmptyArray()
    {
        $config = new Config();
        $config->fromArray([]);

        $this->assertEmpty($config->getClientId());
        $this->assertEmpty($config->getClientSecret());
        $this->assertEmpty($config->getOauthUrl());
        $this->assertEmpty($config->getProject());
        $this->assertEmpty($config->getApiUrl());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUnknownEntry()
    {
        $config = new Config();
        $config->fromArray(['key' => 'value']);
    }
}
