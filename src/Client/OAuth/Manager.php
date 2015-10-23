<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 22.01.15, 12:34
 */

namespace Commercetools\Core\Client\OAuth;

use Commercetools\Core\Error\ApiException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\AbstractHttpClient;
use Commercetools\Core\Cache\CacheAdapterFactory;
use Commercetools\Core\Cache\CacheAdapterInterface;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Error\InvalidClientCredentialsException;
use Commercetools\Core\Error\Message;

/**
 * @package Commercetools\Core\OAuth
 * @internal
 */
class Manager extends AbstractHttpClient
{
    const TOKEN_CACHE_KEY = 'commercetools-io-access-token';

    const ACCESS_TOKEN = 'access_token';
    const EXPIRES_IN = 'expires_in';
    const ERROR = 'error';
    const ERROR_DESCRIPTION = 'error_description';

    const DEFAULT_SCOPE = 'manage_project';
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
     * @param string $scope
     * @return Token
     * @throws InvalidClientCredentialsException
     */
    public function getToken($scope = self::DEFAULT_SCOPE)
    {
        if ($token = $this->getCacheToken($scope)) {
            return new Token($token);
        }

        return $this->refreshToken($scope);
    }

    /**
     * @param string $scope
     * @return Token
     * @throws InvalidClientCredentialsException
     */
    public function refreshToken($scope = self::DEFAULT_SCOPE)
    {
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
     * @throws InvalidClientCredentialsException
     */
    protected function getBearerToken($scope)
    {
        $data = [
            'grant_type' => 'client_credentials',
            'scope' => $scope . ':' . $this->getConfig()->getProject()
        ];

        try {
            $response = $this->execute($data);
        } catch (ApiException $exception) {
            throw ApiException::create($exception->getRequest(), $exception->getResponse());
        }

        $result = json_decode($response->getBody(), true);

        $token = new Token($result[static::ACCESS_TOKEN], $result[static::EXPIRES_IN]);
        $token->setValidTo(new \DateTime('now +' . $result[static::EXPIRES_IN] . ' seconds'));

        return $token;
    }

    /**
     * @param $data
     * @return ResponseInterface
     */
    public function execute($data)
    {
        return $this->getHttpClient()->authenticate(
            $this->getConfig()->getOauthUrl(),
            $this->getConfig()->getClientId(),
            $this->getConfig()->getClientSecret(),
            $data
        );
    }

    /**
     * @return string
     */
    protected function getBaseUrl()
    {
        return $this->getConfig()->getOauthUrl();
    }
}
