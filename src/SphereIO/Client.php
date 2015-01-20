<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 19.01.15
 * Time: 14:29
 */

namespace SphereIO;


use SphereIO\Cache\CacheAdapterInterface;

class Client
{
    protected $cache;

    public function __construct(CacheAdapterInterface $cache)
    {
        $this->cache = $cache;
        $client = new \GuzzleHttp\Client();

        //$response = $client->get('http://www.commercetools.de');
    }

}
