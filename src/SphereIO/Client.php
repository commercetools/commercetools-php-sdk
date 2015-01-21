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

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @param CacheAdapterInterface $cache
     */
    public function __construct(CacheAdapterInterface $cache)
    {
        $this->cache = $cache;

        //$this->getToken();
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

    protected function getToken()
    {
        $config = [
        ];

        $config = (new Config())->fromArray($config);
        $client = $this->getHttpClient();

        $data = [
            'grant_type' => 'client_credentials',
            'scope' => 'manage_project:' . $config->getProject()
        ];

        $result = $client->post(
            $config->getOauthUrl(),
            [
                'body' => $data,
                'auth' => [$config->getClientId(), $config->getClientSecret()]
            ]
        );

        return $result->json();
    }
}
