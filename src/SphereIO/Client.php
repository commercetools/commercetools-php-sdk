<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 14:29
 */

namespace SphereIO;


use SphereIO\Cache\CacheAdapterInterface;
use SphereIO\OAuth\Manager;

class Client extends AbstractHttpClient
{
    const TOKEN_CACHE_KEY = 'sphere-io-bearer-token';

    /**
     * @var CacheAdapterInterface
     */
    protected $cache;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @param CacheAdapterInterface $cache
     */
    public function __construct(Config $config, CacheAdapterInterface $cache)
    {
        $this->cache = $cache;
        $this->config = $config;
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param Config $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return CacheAdapterInterface
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * @param CacheAdapterInterface $cache
     */
    public function setCache($cache)
    {
        $this->cache = $cache;
    }

    public function submit($request = null)
    {
        $manager = new Manager($this->getConfig(), $this->getCache());

        $token = $manager->getToken();

        $client = $this->getHttpClient();
        $result = $client->get(
            $this->getConfig()->getApiUrl() . '/' . $this->getConfig()->getProject() . '/categories',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token->getToken()
                ]
            ]
        )->json();

        var_dump($result);
    }
}
