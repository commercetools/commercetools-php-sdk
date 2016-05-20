<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created 19.01.15, 17:10
 */

namespace Commercetools\Core\Cache;

/**
 * @deprecated use a PSR-6 cache adapter instead. Will be removed with v2.0
 * @package Commercetools\Core\Cache
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
