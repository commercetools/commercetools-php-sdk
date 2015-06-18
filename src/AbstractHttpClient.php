<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 22.01.15, 13:51
 */

namespace Sphere\Core;


use GuzzleHttp\Client as HttpClient;
use Sphere\Core\Client\Adapter\AdapterFactory;
use Sphere\Core\Client\Adapter\AdapterInterface;

/**
 * Class AbstractHttpClient
 * @package Sphere\Core
 */
abstract class AbstractHttpClient
{

    const VERSION = '1.0.0 M3';

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var AdapterFactory
     */
    protected $adapterFactory;

    /**
     * @var Config
     */
    protected $config;

    protected $userAgent;

    /**
     * @param Config|array $config
     */
    public function __construct($config)
    {
        $this->setConfig($config);
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
     * @return Config
     */
    public function getConfig()
    {
        if (is_null($this->config)) {
            $this->config = new Config();
        }
        return $this->config;
    }


    /**
     * @param array $options
     * @return AdapterInterface
     */
    public function getHttpClient($options = [])
    {
        if (is_null($this->httpClient)) {
            $options = array_merge(
                [
                    'base_uri' => $this->getBaseUrl(),
                    'headers' => ['User-Agent' => $this->getUserAgent()]
                ],
                $options
            );
            $class = $this->getAdapterFactory()->getClass($this->getConfig()->getAdapter());

            $this->httpClient = new $class($options);
        }

        return $this->httpClient;
    }

    /**
     * @return AdapterFactory
     */
    public function getAdapterFactory()
    {
        if (is_null($this->adapterFactory)) {
            $this->adapterFactory = new AdapterFactory();
        }

        return $this->adapterFactory;
    }

    abstract protected function getBaseUrl();

    protected function getUserAgent()
    {
        if (is_null($this->userAgent)) {
            $agent = 'sphere-php-sdk ' . static::VERSION;
            if (extension_loaded('curl')) {
                $agent .= ' curl/' . curl_version()['version'];
            }
            $agent .= ' PHP/' . PHP_VERSION;
            $this->userAgent = $agent;
        }

        return $this->userAgent;
    }
}
