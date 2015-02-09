<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 29.01.15, 14:16
 */

namespace Sphere\Core\Client\OAuth;


use Sphere\Core\Config;

class ManagerTest extends \PHPUnit_Framework_TestCase
{

    protected function getConfig()
    {
        $config = new Config();
        $config->fromArray([
                Config::CLIENT_ID => 'id',
                Config::CLIENT_SECRET => 'secret',
                Config::OAUTH_URL => 'oauthUrl',
                Config::PROJECT => 'project',
                Config::API_URL => 'apiUrl'
        ]);
        return $config;
    }

    /**
     * @return Manager
     */
    protected function getMockManager($config, $returnValue)
    {
        $manager = $this->getMock('\Sphere\Core\Client\OAuth\Manager', ['execute'], [$config]);
        $manager->expects($this->any())
            ->method('execute')
            ->will($this->returnValue($returnValue));

        return $manager;
    }

    public function testToken()
    {
        $manager = $this->getMockManager(
            $this->getConfig(),
            [
                "access_token" => "myToken",
                "token_type" => "Bearer",
                "expires_in" => 1000,
                "scope" => "manage_project:project"
            ]
        );
        $this->assertInstanceOf('\Sphere\Core\Client\OAuth\Token', $manager->getToken());
    }

    public function testCache()
    {
        $manager = $this->getMockManager(
            $this->getConfig(),
            [
                "access_token" => "myToken",
                "token_type" => "Bearer",
                "expires_in" => 1000,
                "scope" => "manage_project:project"
            ]
        );
        $manager->getToken(); // first call ensures caching of token
        $this->assertEmpty($manager->getToken()->getTtl()); // ttl should be empty as token comes from cache
    }

    /**
     * @expectedException \Sphere\Core\Client\OAuth\AuthorizeException
     */
    public function testError()
    {
        $manager = $this->getMock(
            '\Sphere\Core\Client\OAuth\Manager',
            ['execute', 'getCacheToken'],
            [$this->getConfig()]
        );
        $manager->expects($this->any())
            ->method('execute')
            ->will($this->returnValue(["error" => "invalid_client"]));
        $manager->expects($this->any())
            ->method('getCacheToken')
            ->will($this->returnValue(false));

        /**
         * @var Manager $manager
         */
        $manager->getToken();
    }

    public function testOAuthUrl()
    {
        $manager = $this->getMockManager($this->getConfig(), []);

        // change visibility of getBaseUrl
        $class = new \ReflectionClass($manager);
        $method = $class->getMethod('getBaseUrl');
        $method->setAccessible(true);
        $output = $method->invoke($manager);

        $this->assertSame($this->getConfig()->getOauthUrl(), $output);
    }
}
