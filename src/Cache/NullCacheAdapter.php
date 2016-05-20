<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created 19.01.15, 17:06
 */

namespace Commercetools\Core\Cache;

/**
 * @deprecated use a PSR-6 cache adapter instead. Will be removed with v2.0
 * @package Commercetools\Core\Cache
 */
class NullCacheAdapter extends AbstractCacheAdapter
{
    protected $cache = [];

    /**
     * @param $key
     * @param $options
     * @return bool
     */
    public function has($key, $options = null)
    {
        return isset($this->cache[$key]);
    }

    /**
     * @param $key
     * @param $options
     * @return bool
     */
    public function fetch($key, $options = null)
    {
        if ($this->has($key)) {
            return $this->cache[$key];
        }
        return false;
    }

    /**
     * @param $key
     * @param $data
     * @param $lifeTime
     * @param $options
     * @return bool
     */
    public function store($key, $data, $lifeTime = null, $options = null)
    {
        $this->cache[$key] = $data;

        return true;
    }

    /**
     * @param $key
     * @param $options
     * @return bool
     */
    public function remove($key, $options = null)
    {
        unset($this->cache[$key]);
        return true;
    }
}
