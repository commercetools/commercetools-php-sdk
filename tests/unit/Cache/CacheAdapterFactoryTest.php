<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 21.01.15, 14:28
 */

namespace Commercetools\Core\Cache;

use Doctrine\Common\Cache\ArrayCache;

class CacheAdapterFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * test if apc is default cache adapter and APC module is available
     */
    public function testApcDefault()
    {
        $this->assertInstanceOf('\Commercetools\Core\Cache\ApcCacheAdapter', $this->getFactory()->get());
    }

    /**
     * test if default adapter returns correct interface
     */
    public function testAdapterInterface()
    {
        $this->assertInstanceOf('\Commercetools\Core\Cache\CacheAdapterInterface', $this->getFactory()->get());
    }

    /**
     * test correct callback behaviour
     */
    public function testCallback()
    {
        $factory = $this->getFactory();
        $factory->registerCallback(
            function () {
                return new NullCacheAdapter();
            }
        );

        $this->assertInstanceOf('\Commercetools\Core\Cache\NullCacheAdapter', $factory->get(new \ArrayObject()));
    }

    public function testDoctrineCacheCallback()
    {
        $factory = $this->getFactory();
        $adapter = $factory->get(new ArrayCache());

        $this->assertInstanceOf('\Commercetools\Core\Cache\DoctrineCacheAdapter', $adapter);
    }

    public function testPhpRedisCacheCallback()
    {
        if (!extension_loaded('redis')) {
            $this->markTestSkipped(
                'The redis extension is not available.'
            );
        }
        $factory = $this->getFactory();
        $adapter = $factory->get(new \Redis());

        $this->assertInstanceOf('\Commercetools\Core\Cache\PhpRedisCacheAdapter', $adapter);
    }

    /**
     * test correct type handling
     *
     * @expectedException \Commercetools\Core\Error\InvalidArgumentException
     */
    public function testNoObjectException()
    {
        $this->getFactory()->get([]);
    }

    /**
     * test correct type handling
     *
     * @expectedException \Commercetools\Core\Error\InvalidArgumentException
     */
    public function testNoAdapterException()
    {
        $this->getFactory()->get(new \ArrayObject());
    }

    protected function getFactory()
    {
        return new CacheAdapterFactory();
    }
}
