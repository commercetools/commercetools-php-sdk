<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 19.01.15
 * Time: 15:31
 */

namespace SphereIO;


use SphereIO\Cache\CacheAdapterFactory;
use SphereIO\Cache\NullCacheAdapter;

class Factory
{
    protected $cacheAdapter;

    public function getCacheAdapter()
    {

    }
    public function getClient()
    {
        CacheAdapterFactory::getInstance()->registerCallback(function ($cache) {
            return new NullCacheAdapter();
        });

        $obj = new Factory();
        $cacheAdapter = CacheAdapterFactory::getInstance()->get($obj);

        return new Client($cacheAdapter);
    }
}
