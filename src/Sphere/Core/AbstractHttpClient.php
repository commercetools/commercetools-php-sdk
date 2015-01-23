<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 22.01.15, 13:51
 */

namespace Sphere\Core;


use GuzzleHttp\Client as HttpClient;
use Sphere\Core\Cache\CacheAdapterInterface;

abstract class AbstractHttpClient
{
    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var Factory
     */
    protected $factory;

    /**
     * @param Factory $factory
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
     * @return CacheAdapterInterface
     */
    public function getCache()
    {
        return $this->getFactory()->getCacheAdapter();
    }

    /**
     * @return HttpClient
     */
    public function getHttpClient()
    {
        if (is_null($this->httpClient)) {
            $this->httpClient = new HttpClient();
        }

        return $this->httpClient;
    }
}
