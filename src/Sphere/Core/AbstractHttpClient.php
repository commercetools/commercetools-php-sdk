<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 22.01.15, 13:51
 */

namespace Sphere\Core;


use GuzzleHttp\Client as HttpClient;

abstract class AbstractHttpClient
{
    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var Config
     */
    protected $config;

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
     * @return HttpClient
     */
    public function getHttpClient()
    {
        if (is_null($this->httpClient)) {
            $this->httpClient = new HttpClient(['base_url' => $this->getBaseUrl()]);
        }

        return $this->httpClient;
    }

    abstract protected function getBaseUrl();
}
