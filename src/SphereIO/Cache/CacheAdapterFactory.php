<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 17:17
 */

namespace SphereIO\Cache;

class CacheAdapterFactory
{
    protected $callbacks = [];

    /**
     * @param $callback
     */
    public function registerCallback($callback)
    {
        $this->callbacks[] = $callback;
    }

    /**
     * @param $cache
     * @return CacheAdapterInterface
     * @throws \InvalidArgumentException
     */
    public function get($cache = null)
    {
        if (is_null($cache)) {
            $cache = $this->getDefaultCache();
        }
        if (!is_object($cache)) {
            throw new \InvalidArgumentException();
        }

        if ($cache instanceof CacheAdapterInterface) {
            return $cache;
        }

        foreach($this->callbacks as $callBack) {
            $result = call_user_func($callBack, $cache);
            if ($result instanceof CacheAdapterInterface) {
                return $result;
            }
        }

        throw new \InvalidArgumentException();
    }

    /**
     * @return CacheAdapterInterface
     */
    protected function getDefaultCache()
    {
        if (extension_loaded('apc')) {
            return new ApcCacheAdapter();
        }

        return new NullCacheAdapter();
    }
}
