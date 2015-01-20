<?php
/**
 * Created by PhpStorm.
 * User: Jens Schulze <jens.schulze@commercetools.de>
 * Date: 19.01.15
 * Time: 17:06
 */

namespace SphereIO\Cache;

/**
 * Class NullCacheAdapter
 * @package SphereIO\Cache
 */
class NullCacheAdapter extends AbstractCacheAdapter
{
    public function has($key, $options = null)
    {
        return false;
    }

    public function get($key, $options = null)
    {
        return false;
    }

    public function store($key, $data, $lifeTime = null, $options = null)
    {
        return true;
    }

    public function remove($key, $options = null)
    {
        return true;
    }
}
