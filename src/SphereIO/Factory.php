<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 15:31
 */

namespace SphereIO;


use SphereIO\Cache\CacheAdapterFactory;
use SphereIO\Cache\CacheAdapterInterface;
use SphereIO\Cache\NullCacheAdapter;

class Factory
{
    protected $cacheAdapter;
    protected $cacheAdapterFactory;

    /**
     * @return CacheAdapterFactory
     */
    public function getCacheAdapterFactory()
    {
        if (is_null($this->cacheAdapterFactory)) {
            $this->cacheAdapterFactory = new CacheAdapterFactory();
        }
        return $this->cacheAdapterFactory;
    }

    /**
     * @return CacheAdapterInterface
     */
    public function getCacheAdapter()
    {
        return $this->cacheAdapter;
    }

    /**
     * @param $cache
     * @return $this
     */
    public function setCacheAdapter($cache)
    {
        $this->cacheAdapter = $this->getCacheAdapterFactory()->get($cache);

        return $this;
    }

    /**
     * @param $cache
     */
    public function __construct($cache = null)
    {
        $this->setCacheAdapter($cache);
    }

    public function getClient()
    {
        return new Client($this->getCacheAdapter());
    }
}
