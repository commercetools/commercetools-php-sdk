<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 22.01.15, 13:51
 */

namespace Commercetools\Core;

use Commercetools\Core\Client\Adapter\AdapterFactory;
use Commercetools\Core\Client\Adapter\AdapterInterface;

/**
 * @package Commercetools\Core
 */
abstract class AbstractHttpClient
{
    const VERSION = '2.17.0';

    /**
     * @var AdapterInterface
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
            $this->config = Config::fromArray($config);
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
            $headers = ['User-Agent' => $this->getUserAgent()];
            if (!is_null($this->getConfig()->getAcceptEncoding())) {
                $headers['Accept-Encoding'] = $this->getConfig()->getAcceptEncoding();
            }
            $options = array_merge(
                [
                    'base_uri' => $this->getBaseUrl(),
                    'headers' => $headers
                ],
                $options
            );
            $this->httpClient = $this->getAdapterFactory()->getAdapter($this->getConfig()->getAdapter(), $options);
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
            $agent = 'commercetools-php-sdk/' . static::VERSION;

            $adapterClass = $this->getAdapterFactory()->getClass($this->getConfig()->getAdapter());
            $agent .= ' (' . $adapterClass::getAdapterInfo();
            if (extension_loaded('curl') && function_exists('curl_version')) {
                $agent .= '; curl/' . \curl_version()['version'];
            }
            $agent .= ') PHP/' . PHP_VERSION;
            $this->userAgent = $agent;
        }

        return $this->userAgent;
    }
}
