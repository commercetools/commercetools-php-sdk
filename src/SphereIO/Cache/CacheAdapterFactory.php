<?php
/**
 * Created by PhpStorm.
 * User: Jens Schulze <jens.schulze@commercetools.de>
 * Date: 19.01.15
 * Time: 17:17
 */

namespace SphereIO\Cache;

class CacheAdapterFactory
{
    protected static $instance;

    protected $callbacks = [];

    /**
     * @return CacheAdapterFactory
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

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
