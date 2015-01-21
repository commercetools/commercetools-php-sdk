<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 17:36
 */

namespace SphereIO\Cache;

use Doctrine\Common\Cache\Cache;

/**
 * Class DoctrineCacheAdapter
 * @package SphereIO\Cache
 */
class DoctrineCacheAdapter extends AbstractCacheAdapter
{

    /**
     * @param \Doctrine\Common\Cache\Cache $cache
     */
    public function __construct(Cache $cache)
    {
        parent::__construct($cache);
    }

    /**
     * @param $key
     * @param mixed $options
     * @return bool
     */
    public function has($key, $options = null)
    {
        return $this->getCache()->contains($key);
    }

    /**
     * @param $key
     * @param mixed $options
     * @return mixed|bool
     */
    public function fetch($key, $options = null)
    {
        return $this->getCache()->fetch($key);
    }

    /**
     * @param $key
     * @param $data
     * @param mixed $lifeTime
     * @param mixed $options
     * @return bool
     */
    public function store($key, $data, $lifeTime = null, $options = null)
    {
        return $this->getCache()->save($key, $data, $lifeTime);
    }

    /**
     * @param $key
     * @param mixed $options
     * @return bool
     */
    public function remove($key, $options = null)
    {
        return $this->getCache()->delete($key);
    }
}
