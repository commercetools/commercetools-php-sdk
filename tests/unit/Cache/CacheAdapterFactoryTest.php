<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Cache;

use Cache\Adapter\Apcu\ApcuCachePool;
use Cache\Adapter\Doctrine\DoctrineCachePool;
use Cache\Adapter\Filesystem\FilesystemCachePool;
use Cache\Adapter\PHPArray\ArrayCachePool;
use Cache\Adapter\Redis\RedisCachePool;
use Commercetools\Core\Error\InvalidArgumentException;
use Doctrine\Common\Cache\ArrayCache;
use Psr\SimpleCache\CacheInterface;

class CacheAdapterFactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * test if apc is default cache adapter and APC module is available
     */
    public function testApcDefault()
    {
        if (extension_loaded('apcu')) {
            $this->assertInstanceOf(ApcuCachePool::class, $this->getFactory()->get());
        } elseif (class_exists('\Cache\Adapter\Filesystem\FilesystemCachePool')) {
            $this->assertInstanceOf(FilesystemCachePool::class, $this->getFactory()->get());
        } else {
            $this->assertNull($this->getFactory()->get());
        }
    }

    /**
     * test correct callback behaviour
     */
    public function testCallback()
    {
        $factory = $this->getFactory();
        $factory->registerCallback(
            function () {
                return new ArrayCachePool();
            }
        );

        $this->assertInstanceOf(ArrayCachePool::class, $factory->get(new \ArrayObject()));
    }

    public function testDoctrineCacheCallback()
    {
        $factory = $this->getFactory();
        $adapter = $factory->get(new ArrayCache());

        $this->assertInstanceOf(DoctrineCachePool::class, $adapter);
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

        $this->assertInstanceOf(RedisCachePool::class, $adapter);
    }

    public function testPsrCache()
    {
        $factory = $this->getFactory();
        $adapter = $factory->get(new ArrayCachePool());

        $this->assertInstanceOf(ArrayCachePool::class, $adapter);
    }

    public function testSimpleCache()
    {
        $cache = $this->prophesize(CacheInterface::class);
        $factory = $this->getFactory();
        $adapter = $factory->get($cache->reveal());

        $this->assertInstanceOf(CacheInterface::class, $adapter);
    }

    /**
     * test correct type handling
     */
    public function testNoObjectException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->getFactory()->get([]);
    }

    /**
     * test correct type handling
     */
    public function testNoAdapterException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->getFactory()->get(new \ArrayObject());
    }

    protected function getFactory()
    {
        return new CacheAdapterFactory();
    }
}
