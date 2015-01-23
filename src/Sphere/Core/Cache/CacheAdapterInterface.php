<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 17:02
 */

namespace Sphere\Core\Cache;

/**
 * Interface CacheAdapterInterface
 * @package Sphere\Core\Cache
 */
interface CacheAdapterInterface
{
    /**
     * checks if key is present in the cache
     *
     * @param $key
     * @param mixed $options
     * @return bool
     */
    public function has($key, $options = null);

    /**
     * fetches cached object from cache or returns false if not found
     *
     * @param $key
     * @param mixed $options
     * @return mixed|bool
     */
    public function fetch($key, $options = null);

    /**
     * saves the data in the cache
     *
     * @param $key
     * @param $data
     * @param $lifeTime
     * @param $options
     * @return bool
     */
    public function store($key, $data, $lifeTime = null, $options = null);

    /**
     * removes the key from cache
     *
     * @param $key
     * @param mixed $options
     * @return bool
     */
    public function remove($key, $options = null);
}
