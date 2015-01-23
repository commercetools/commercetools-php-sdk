<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 15:31
 */

namespace Sphere\Core;


use Sphere\Core\Cache\CacheAdapterFactory;
use Sphere\Core\Cache\CacheAdapterInterface;
use Sphere\Core\OAuth\Manager;

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
     * @var Manager
     */
    protected $manager;

    /**
     * @return Config $this
     */
    public function getConfig()
    {
        if (is_null($this->config)) {
            $this->config = new Config();
        }
        return $this->config;
    }

    /**
     * @param Config|array $config
     * @return $this
     */
    public function setConfig($config)
    {
        if ($config instanceof Config) {
            $this->config = $config;
        } elseif (is_array($config)) {
            $this->getConfig()->fromArray($config);
        }
        $this->getConfig()->check();

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
     * @param Config|array $config
     * @param $cache
     */
    public function __construct($config, $cache = null)
    {
        $this->setConfig($config);
        $this->setCacheAdapter($cache);

    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return new Client($this);
    }

    /**
     * @return Manager
     */
    public function getOAuthManager()
    {
        if (is_null($this->manager)) {
            $this->manager = new Manager($this);
        }

        return $this->manager;
    }
}
