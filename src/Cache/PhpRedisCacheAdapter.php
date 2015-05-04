<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Cache;

/**
 * Class PhpRedisCacheAdapter
 * @package Sphere\Core\Cache
 */
class PhpRedisCacheAdapter extends AbstractCacheAdapter
{
    /**
     * @param \Redis $cache
     */
    public function __construct(\Redis $cache)
    {
        $this->setCache($cache);
    }

    /**
     * checks if key is present in the cache
     *
     * @param $key
     * @param mixed $options
     * @return bool
     */
    public function has($key, $options = null)
    {
        return $this->getCache()->exists($key);
    }

    /**
     * fetches cached object from cache or returns false if not found
     *
     * @param $key
     * @param mixed $options
     * @return mixed|bool
     */
    public function fetch($key, $options = null)
    {
        return unserialize($this->getCache()->get($key));
    }

    /**
     * saves the data in the cache
     *
     * @param $key
     * @param $data
     * @param $lifeTime
     * @param $options
     * @return bool
     */
    public function store($key, $data, $lifeTime = null, $options = null)
    {
        $data = serialize($data);
        if (!is_null($lifeTime)) {
            return $this->getCache()->setex($key, $lifeTime, $data);
        } else {
            return $this->getCache()->set($key, $data);
        }
    }

    /**
     * removes the key from cache
     *
     * @param $key
     * @param mixed $options
     * @return bool
     */
    public function remove($key, $options = null)
    {
        return (bool)$this->getCache()->del($key);
    }
}
