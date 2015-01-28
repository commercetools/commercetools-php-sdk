<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 17:17
 */

namespace Sphere\Core\Cache;

use Sphere\Core\Error\Message;
use Sphere\Core\Error\InvalidArgumentException;

/**
 * Class CacheAdapterFactory
 * @package Sphere\Core\Cache
 */
class CacheAdapterFactory
{
    /**
     * @var array
     */
    protected $callbacks = [];

    /**
     * registers a callback to resolve a cache adapter interface
     *
     * @param $callback
     */
    public function registerCallback($callback)
    {
        $this->callbacks[] = $callback;
    }

    /**
     * returns the cache adapter interface for the application cache
     *
     * @param $cache
     * @return CacheAdapterInterface
     * @throws \InvalidArgumentException
     */
    public function get($cache = null)
    {
        if (is_null($cache)) {
            $cache = $this->getDefaultCache();
        }

        if ($cache instanceof CacheAdapterInterface) {
            return $cache;
        }

        foreach ($this->callbacks as $callBack) {
            $result = call_user_func($callBack, $cache);
            if ($result instanceof CacheAdapterInterface) {
                return $result;
            }
        }

        throw new InvalidArgumentException(Message::INVALID_CACHE_ADAPTER);
    }

    /**
     * creates a default cache adapter if no cache has been provided
     *
     * @return CacheAdapterInterface|null
     */
    protected function getDefaultCache()
    {
        if (extension_loaded('apc')) {
            return new ApcCacheAdapter();
        }

        return null;
    }
}
