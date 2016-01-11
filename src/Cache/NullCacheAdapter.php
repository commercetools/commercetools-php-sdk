<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created 19.01.15, 17:06
 */

namespace Commercetools\Core\Cache;

/**
 * @package Commercetools\Core\Cache
 */
class NullCacheAdapter extends AbstractCacheAdapter
{
    /**
     * @param $key
     * @param $options
     * @return bool
     */
    public function has($key, $options = null)
    {
        return false;
    }

    /**
     * @param $key
     * @param $options
     * @return bool
     */
    public function fetch($key, $options = null)
    {
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
        return true;
    }

    /**
     * @param $key
     * @param $options
     * @return bool
     */
    public function remove($key, $options = null)
    {
        return true;
    }
}
