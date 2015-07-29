<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 17:10
 */

namespace Sphere\Core\Cache;

/**
 * @package Sphere\Core\Cache
 */
abstract class AbstractCacheAdapter implements CacheAdapterInterface
{
    /**
     * holds the instance of the application cache
     * @var mixed
     */
    protected $cache;

    /**
     * @param mixed $cache
     */
    protected function setCache($cache)
    {
        $this->cache = $cache;
    }

    /**
     * returns the application cache instance
     *
     * @return mixed
     */
    public function getCache()
    {
        return $this->cache;
    }
}
