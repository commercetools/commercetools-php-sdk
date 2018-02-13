<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created 19.01.15, 17:17
 */

namespace Commercetools\Core\Cache;

use Cache\Adapter\Apcu\ApcuCachePool;
use Cache\Adapter\Doctrine\DoctrineCachePool;
use Cache\Adapter\Filesystem\FilesystemCachePool;
use Cache\Adapter\Redis\RedisCachePool;
use Doctrine\Common\Cache\Cache;
use Commercetools\Core\Error\Message;
use Commercetools\Core\Error\InvalidArgumentException;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Psr\Cache\CacheItemPoolInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @package Commercetools\Core\Cache
 */
class CacheAdapterFactory
{
    /**
     * @var string
     */
    private $cacheDir;

    /**
     * @var array
     */
    protected $callbacks = [];

    public function __construct($cacheDir = null)
    {
        $this->cacheDir = !is_null($cacheDir) ? $cacheDir : realpath(__DIR__ . '/../..');
        $this->registerCallback(
            function ($cache) {
                if ($cache instanceof Cache) {
                    return new DoctrineCachePool($cache);
                }
                return null;
            }
        )
        ->registerCallback(
            function ($cache) {
                if ($cache instanceof \Redis) {
                    return new RedisCachePool($cache);
                }
                return null;
            }
        );
    }

    /**
     * registers a callback to resolve a cache adapter interface
     *
     * @param callable $callback
     * @return $this
     */
    public function registerCallback(callable $callback)
    {
        $this->callbacks[] = $callback;

        return $this;
    }

    /**
     * returns the cache adapter interface for the application cache
     *
     * @param $cache
     * @return CacheItemPoolInterface|CacheInterface
     * @throws \InvalidArgumentException
     */
    public function get($cache = null)
    {
        if (is_null($cache)) {
            $cache = $this->getDefaultCache();
        }

        if ($cache instanceof CacheItemPoolInterface) {
            return $cache;
        }
        if ($cache instanceof CacheInterface) {
            return $cache;
        }

        foreach ($this->callbacks as $callBack) {
            $result = call_user_func($callBack, $cache);
            if ($result instanceof CacheItemPoolInterface) {
                return $result;
            }
            if ($result instanceof CacheInterface) {
                return $result;
            }
        }

        throw new InvalidArgumentException(Message::INVALID_CACHE_ADAPTER);
    }

    /**
     * creates a default cache adapter if no cache has been provided
     *
     * @return CacheItemPoolInterface|null
     */
    protected function getDefaultCache()
    {
        if (extension_loaded('apcu')) {
            return new ApcuCachePool();
        }

        if (class_exists('\Cache\Adapter\Filesystem\FilesystemCachePool')) {
            $filesystemAdapter = new Local($this->cacheDir);
            $filesystem        = new Filesystem($filesystemAdapter);
            return new FilesystemCachePool($filesystem);
        }

        return null;
    }
}
