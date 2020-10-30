<?php

namespace Commercetools\Core\Client;

use Commercetools\Core\Client\Adapter\AdapterFactory;
use Commercetools\Core\Client\Adapter\Guzzle5Adapter;
use Commercetools\Core\Client\Adapter\Guzzle6Adapter;
use PHPUnit\Framework\TestCase;

class AdapterFactoryTest extends TestCase
{
    public function testGetClassGuzzle5()
    {
        $adapter = new AdapterFactory();
        if (defined('\GuzzleHttp\Client::VERSION') && strpos(constant('\GuzzleHttp\Client::VERSION'), '5.') === 0) {
            $this->assertSame(Guzzle5Adapter::class, $adapter->getClass());
        } else {
            $this->markTestSkipped("No guzzle 5 installed");
        }
    }

    public function testGetClassGuzzle6()
    {
        $adapter = new AdapterFactory();
        if (defined('\GuzzleHttp\Client::VERSION') && strpos(constant('\GuzzleHttp\Client::VERSION'), '6.') === 0) {
            $this->assertSame(Guzzle6Adapter::class, $adapter->getClass());
        } else {
            $this->markTestSkipped("No guzzle 6 installed");
        }
    }

    public function testGetClassGuzzle7()
    {
        $adapter = new AdapterFactory();
        if (defined('\GuzzleHttp\Client::MAJOR_VERSION') && constant('\GuzzleHttp\Client::MAJOR_VERSION') === 7) {
            $this->assertSame(Guzzle6Adapter::class, $adapter->getClass());
        } else {
            $this->markTestSkipped("No guzzle 6 installed");
        }
    }

    /**
     * @dataProvider getClass
     */
    public function testGetClassByName($adapterName, $expectedClassName)
    {
        $adapter = new AdapterFactory();
        $this->assertSame($expectedClassName, $adapter->getClass($adapterName));
    }

    /**
     * @dataProvider getClass
     */
    public function testGetAdapterByName($adapterName, $expectedClassName)
    {
        $adapter = new AdapterFactory();
        $this->assertInstanceOf($expectedClassName, $adapter->getAdapter($adapterName, []));
    }


    public function getClass()
    {
        return [
            'guzzle6' => ['guzzle6', Guzzle6Adapter::class],
            'guzzle5' => ['guzzle5', Guzzle5Adapter::class]
        ];
    }
}
