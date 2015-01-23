<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 22.01.15, 13:51
 */

namespace Sphere\Core;


use GuzzleHttp\Client;
use Sphere\Core\Cache\CacheAdapterInterface;

abstract class AbstractHttpClient
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * @var Factory
     */
    protected $factory;

    /**
     * @param CacheAdapterInterface $cache
     */
    public function __construct(Factory $factory)
    {
        $this->setFactory($factory);
    }

    /**
     * @return Factory
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * @param Factory $factory
     */
    public function setFactory($factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->getFactory()->getConfig();
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
        return $this->getFactory()->getCacheAdapter();
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient()
    {
        if (is_null($this->httpClient)) {
            $this->httpClient = new Client();
        }

        return $this->httpClient;
    }
}
