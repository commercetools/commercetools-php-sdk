<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 14:29
 */

namespace SphereIO;


use SphereIO\Cache\CacheAdapterInterface;

class Client
{
    /**
     * @var CacheAdapterInterface
     */
    protected $cache;

    protected $client;

    /**
     * @param CacheAdapterInterface $cache
     */
    public function __construct(CacheAdapterInterface $cache)
    {
        $this->cache = $cache;
        $client = $this->getHttpClient();

        $response = $client->get('http://www.commercetools.de');
    }

    /**
     * @return \GuzzleHttp\Client
     */
    protected function getHttpClient()
    {
        if (is_null($this->client)) {
            $this->client = new \GuzzleHttp\Client();
        }

        return $this->client;
    }
}
