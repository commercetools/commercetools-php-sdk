<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Cache;

use Psr\Cache\CacheItemPoolInterface;

class PsrCacheAdapter implements CacheAdapterInterface
{
    private $pool;

    public function __construct(CacheItemPoolInterface $pool)
    {
        $this->pool = $pool;
    }

    /**
     * @param $key
     * @param null $options
     * @return bool|\string[]
     */
    public function has($key, $options = null)
    {
        return $this->pool->hasItem($key);
    }

    /**
     * @param $key
     * @param mixed $options
     * @return mixed|false
     */
    public function fetch($key, $options = null)
    {
        $item = $this->pool->getItem($key);
        return $item->isHit() ? $item->get() : false;
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
        $item = $this->pool->getItem($key);
        $item->set($data);
        if (!is_null($lifeTime)) {
            $item->expiresAfter($lifeTime);
        }
        return $this->pool->save($item);
    }

    /**
     * @param $key
     * @param mixed $options
     * @return bool
     */
    public function remove($key, $options = null)
    {
        return $this->pool->deleteItem($key);
    }
}
