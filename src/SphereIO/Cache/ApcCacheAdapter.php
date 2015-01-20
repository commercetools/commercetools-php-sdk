<?php
/**
 * Created by PhpStorm.
 * User: Jens Schulze <jens.schulze@commercetools.de>
 * Date: 20.01.15
 * Time: 13:42
 */

namespace SphereIO\Cache;


class ApcCacheAdapter extends AbstractCacheAdapter
{
    /**
     * @param $key
     * @param mixed $options
     * @return bool
     */
    public function has($key, $options = null)
    {
        return apc_exists($key);
    }

    /**
     * @param $key
     * @param mixed $options
     * @return mixed|null
     */
    public function get($key, $options = null)
    {
        return apc_fetch($key);
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
        return apc_store($key, $data, $lifeTime);
    }

    /**
     * @param $key
     * @param mixed $options
     * @return bool
     */
    public function remove($key, $options = null)
    {
        return apc_delete($key);
    }

}
