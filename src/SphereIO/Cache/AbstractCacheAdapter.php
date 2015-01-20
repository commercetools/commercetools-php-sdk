<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 17:10
 */

namespace SphereIO\Cache;

/**
 * Class AbstractCacheAdapter
 * @package SphereIO\Cache
 */
abstract class AbstractCacheAdapter implements CacheAdapterInterface
{
    protected $cache;

    /**
     * returns the cache adapter
     *
     * @return mixed
     */
    public function getCache()
    {
        return $this->cache;
    }
}
