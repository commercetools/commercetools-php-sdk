<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 22.01.15, 12:34
 */

namespace SphereIO\OAuth;


use SphereIO\AbstractHttpClient;
use SphereIO\Cache\CacheAdapterInterface;
use SphereIO\Config;

class Manager extends AbstractHttpClient
{
    const TOKEN_CACHE_KEY = 'sphere-io-bearer-token';

    const ACCESS_TOKEN = 'access_token';
    const EXPIRES_IN = 'expires_in';
    const ERROR = 'error';
    const ERROR_DESCRIPTION = 'error_description';

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var CacheAdapterInterface
     */
    protected $cache;

    public function __construct(Config $config, CacheAdapterInterface $cache)
    {
        $this->cache = $cache;
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

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @return Token
     * @throws AuthorizeException
     */
    public function getToken()
    {
        if ($token = $this->getCache()->fetch(static::TOKEN_CACHE_KEY)) {
            return new Token($token);
        }
        $token = $this->getBearerToken();
        $this->getCache()->store(static::TOKEN_CACHE_KEY, $token->getToken(), $token->getTtl());

        return $token;
    }

    /**
     * @param string $scope
     * @return Token
     * @throws AuthorizeException
     */
    protected function getBearerToken($scope = 'manage_project')
    {
        $data = [
            'grant_type' => 'client_credentials',
            'scope' => $scope . ':' . $this->getConfig()->getProject()
        ];

        $result = $this->getHttpClient()->post(
            $this->getConfig()->getOauthUrl(),
            [
                'body' => $data,
                'auth' => [$this->getConfig()->getClientId(), $this->getConfig()->getClientSecret()]
            ]
        )->json();

        if (isset($result[static::ERROR])) {
            $message = isset($result[static::ERROR_DESCRIPTION]) ? $result[static::ERROR_DESCRIPTION] : $result[static::ERROR];
            throw new AuthorizeException($message);
        }

        $token = new Token($result[static::ACCESS_TOKEN], $result[static::EXPIRES_IN]);
        $token->setValidTo(new \DateTime('now +' . $result[static::EXPIRES_IN] . ' seconds'));

        return $token;
    }
}
