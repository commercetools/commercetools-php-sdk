<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 17:02
 */

namespace SphereIO\Cache;

/**
 * Interface CacheAdapterInterface
 * @package SphereIO\Cache
 */
interface CacheAdapterInterface
{
    /**
     * @param $key
     * @param mixed $options
     * @return bool
     */
    public function has($key, $options = null);

    /**
     * @param $key
     * @param mixed $options
     * @return mixed|bool
     */
    public function get($key, $options = null);

    /**
     * @param $key
     * @param $data
     * @param $lifeTime
     * @param $options
     * @return bool
     */
    public function store($key, $data, $lifeTime = null, $options = null);

    /**
     * @param $key
     * @param mixed $options
     * @return bool
     */
    public function remove($key, $options = null);
}
