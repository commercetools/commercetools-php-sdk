<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 20.01.15, 13:42
 */

namespace Commercetools\Core\Cache;

/**
 * @package Commercetools\Core\Cache
 */
class ApcuCacheAdapter extends AbstractCacheAdapter
{
    /**
     * @param $key
     * @param null $options
     * @return bool|\string[]
     */
    public function has($key, $options = null)
    {
        return apcu_exists($key);
    }

    /**
     * @param $key
     * @param mixed $options
     * @return mixed|false
     */
    public function fetch($key, $options = null)
    {
        return apcu_fetch($key);
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
        return apcu_store($key, $data, $lifeTime);
    }

    /**
     * @param $key
     * @param mixed $options
     * @return bool
     */
    public function remove($key, $options = null)
    {
        return apcu_delete($key);
    }
}
