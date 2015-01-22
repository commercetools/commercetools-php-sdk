<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 15:31
 */

namespace SphereIO;


use SphereIO\Cache\CacheAdapterFactory;
use SphereIO\Cache\CacheAdapterInterface;

class Factory
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var CacheAdapterInterface
     */
    protected $cacheAdapter;

    /**
     * @var CacheAdapterFactory
     */
    protected $cacheAdapterFactory;

    /**
     * @return Config $this
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param Config $config
     * @return $this
     */
    public function setConfig(Config $config)
    {
        $this->config = $config;

        return $this;
    }

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
     * @param array $config
     */
    public function __construct($cache = null, array $config = null)
    {
        $this->setCacheAdapter($cache);
        if (is_array($config)) {
            $this->setConfig((new Config())->fromArray($cache));
        }
    }

    public function getClient()
    {
        return new Client($this->getConfig(), $this->getCacheAdapter());
    }
}
