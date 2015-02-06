<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 22.01.15, 12:34
 */

namespace Sphere\Core\Client\OAuth;


use Sphere\Core\AbstractHttpClient;
use Sphere\Core\Cache\CacheAdapterFactory;
use Sphere\Core\Cache\CacheAdapterInterface;
use Sphere\Core\Error\Message;

/**
 * Class Manager
 * @package Sphere\Core\OAuth
 * @internal
 */
class Manager extends AbstractHttpClient
{
    const TOKEN_CACHE_KEY = 'sphere-io-access-token';

    const ACCESS_TOKEN = 'access_token';
    const EXPIRES_IN = 'expires_in';
    const ERROR = 'error';
    const ERROR_DESCRIPTION = 'error_description';

    /**
     * @var array
     */
    protected $cacheKeys;

    /**
     * @var CacheAdapterInterface
     */
    protected $cacheAdapter;

    /**
     * @var CacheAdapterFactory
     */
    protected $cacheAdapterFactory;

    public function __construct($config, $cache = null)
    {
        parent::__construct($config);
        $this->cacheKeys = [];
        $this->setCacheAdapter($cache);
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
     * @param $cache
     * @return $this
     */
    public function setCacheAdapter($cache)
    {
        $this->cacheAdapter = $this->getCacheAdapterFactory()->get($cache);

        return $this;
    }

    /**
     * @return CacheAdapterInterface
     */
    public function getCacheAdapter()
    {
        return $this->cacheAdapter;
    }

    /**
     * @return Token
     * @throws AuthorizeException
     */
    public function getToken($scope = 'manage_project')
    {
        if ($token = $this->getCacheToken($scope)) {
            return new Token($token);
        }
        $token = $this->getBearerToken($scope);
        // ensure token to be invalidated in cache before TTL
        $ttl = max(1, floor($token->getTtl()/2));
        $this->getCacheAdapter()->store($this->getCacheKey($scope), $token->getToken(), $ttl);

        return $token;
    }

    protected function getCacheToken($scope)
    {
        return $this->getCacheAdapter()->fetch($this->getCacheKey($scope));
    }

    /**
     * @param $scope
     * @return string
     */
    protected function getCacheKey($scope)
    {
        if (!isset($this->cacheKeys[$scope])) {
            $this->cacheKeys[$scope] = static::TOKEN_CACHE_KEY . '-' .
                sha1($scope . '-' . $this->getConfig()->getProject());
        }

        return $this->cacheKeys[$scope];
    }

    /**
     * @param string $scope
     * @return Token
     * @throws AuthorizeException
     */
    protected function getBearerToken($scope)
    {
        $data = [
            'grant_type' => 'client_credentials',
            'scope' => $scope . ':' . $this->getConfig()->getProject()
        ];

        $options = [
            'allow_redirects' => false,
            'verify' => true,
            'timeout' => 60,
            'connect_timeout' => 10,
            'body' => $data,
            'auth' => [$this->getConfig()->getClientId(), $this->getConfig()->getClientSecret()]
        ];
        $result = $this->execute($this->getConfig()->getOauthUrl(), $options);

        if (isset($result[static::ERROR])) {
            $message = isset($result[static::ERROR_DESCRIPTION]) ?
                $result[static::ERROR_DESCRIPTION] : $result[static::ERROR];
            throw new AuthorizeException(sprintf(Message::AUTHENTICATION_FAIL, $message));
        }

        $token = new Token($result[static::ACCESS_TOKEN], $result[static::EXPIRES_IN]);
        $token->setValidTo(new \DateTime('now +' . $result[static::EXPIRES_IN] . ' seconds'));

        return $token;
    }

    /**
     * @param $url
     * @param $options
     * @return mixed
     */
    protected function execute($url, $options)
    {
        return $this->getHttpClient()->post($url, $options)->json();
    }

    /**
     * @return string
     */
    protected function getBaseUrl()
    {
        return $this->getConfig()->getOauthUrl();
    }
}
