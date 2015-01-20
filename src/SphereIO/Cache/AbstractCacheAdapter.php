<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 19.01.15
 * Time: 17:00
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
