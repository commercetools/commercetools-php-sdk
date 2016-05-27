<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Cache;

use Cache\Adapter\PHPArray\ArrayCachePool;
use Doctrine\Common\Cache\ArrayCache;

class CacheAdapterFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * test if apc is default cache adapter and APC module is available
     */
    public function testApcDefault()
    {
        if (extension_loaded('apcu')) {
            $this->assertInstanceOf('\Commercetools\Core\Cache\ApcuCacheAdapter', $this->getFactory()->get());
        } elseif (extension_loaded('apc')) {
            $this->assertInstanceOf('\Commercetools\Core\Cache\ApcCacheAdapter', $this->getFactory()->get());
        } elseif (class_exists('\Cache\Adapter\Filesystem\FilesystemCachePool')) {
            $this->assertInstanceOf('\Cache\Adapter\Filesystem\FilesystemCachePool', $this->getFactory()->get());
        } else {
            $this->assertNull($this->getFactory()->get());
        }
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

    public function testPsrCache()
    {
        if (version_compare(phpversion(), '5.5.0', '<')) {
            $this->markTestSkipped(
                'PHP >= 5.5 needed to run this test'
            );
        }
        $factory = $this->getFactory();
        $adapter = $factory->get(new ArrayCachePool());

        $this->assertInstanceOf('\Cache\Adapter\PHPArray\ArrayCachePool', $adapter);
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
