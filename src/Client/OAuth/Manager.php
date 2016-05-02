<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 22.01.15, 12:34
 */

namespace Commercetools\Core\Client\OAuth;

use Commercetools\Core\Config;
use Commercetools\Core\Error\ApiException;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\AbstractHttpClient;
use Commercetools\Core\Cache\CacheAdapterFactory;
use Commercetools\Core\Cache\CacheAdapterInterface;
use Commercetools\Core\Error\InvalidClientCredentialsException;

/**
 * @package Commercetools\Core\OAuth
 * @internal
 */
class Manager extends AbstractHttpClient
{
    const TOKEN_CACHE_KEY = 'commercetools-io-access-token';

    const REFRESH_TOKEN = 'refresh_token';
    const ACCESS_TOKEN = 'access_token';
    const EXPIRES_IN = 'expires_in';
    const ERROR = 'error';
    const SCOPE = 'scope';
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
     * @param string $scope
     * @return Token
     * @throws InvalidClientCredentialsException
     */
    public function getToken()
    {
        $scope = $this->getConfig()->getScope();
        if ($token = $this->getCacheToken()) {
            return new Token($token, null, $scope);
        }

        return $this->refreshToken();
    }

    /**
     * @return Token
     * @throws InvalidClientCredentialsException
     */
    public function refreshToken()
    {
        $scope = $this->getConfig()->getScope();
        $grantType = $this->getConfig()->getGrantType();
        $data = [Config::SCOPE => $scope, Config::GRANT_TYPE => $grantType];

        if ($grantType === Config::GRANT_TYPE_PASSWORD) {
            $user = $this->getConfig()->getUsername();
            $password = $this->getConfig()->getPassword();
            $data[Config::USER_NAME] = $user;
            $data[Config::PASSWORD] = $password;
        } elseif ($grantType === Config::GRANT_TYPE_REFRESH) {
            $refreshToken = $this->getConfig()->getRefreshToken();
            $data[Config::REFRESH_TOKEN] = $refreshToken;
        }
        
        $token = $this->getBearerToken($data);

        if ($grantType === Config::GRANT_TYPE_PASSWORD) {
            $this->getConfig()->setGrantType(Config::GRANT_TYPE_REFRESH);
            $this->getConfig()->setRefreshToken($token->getRefreshToken());
        }

        // ensure token to be invalidated in cache before TTL
        $ttl = max(1, floor($token->getTtl()/2));
        $this->getCacheAdapter()->store($this->getCacheKey(), $token->getToken(), $ttl);

        return $token;
    }

    protected function getCacheToken()
    {
        return $this->getCacheAdapter()->fetch($this->getCacheKey());
    }

    /**
     * @return string
     */
    protected function getCacheKey()
    {
        $scope = $this->getConfig()->getScope();
        $grantType = $this->getConfig()->getGrantType();
        $cacheScope = $scope . '-' . $grantType;

        if ($grantType === Config::GRANT_TYPE_PASSWORD) {
            $user = $this->getConfig()->getUsername();
            $cacheScope .= '-' . $user;
        } elseif ($grantType === Config::GRANT_TYPE_REFRESH) {
            $token = $this->getConfig()->getRefreshToken();
            $cacheScope .= '-' . $token;
        }

        if (!isset($this->cacheKeys[$cacheScope])) {
            $this->cacheKeys[$cacheScope] = static::TOKEN_CACHE_KEY . '-' .
                sha1($cacheScope);
        }

        return $this->cacheKeys[$cacheScope];
    }

    /**
     * @param array $data
     * @return Token
     * @throws ApiException
     * @throws \Commercetools\Core\Error\BadGatewayException
     * @throws \Commercetools\Core\Error\GatewayTimeoutException
     * @throws \Commercetools\Core\Error\ServiceUnavailableException
     */
    protected function getBearerToken(array $data)
    {
        try {
            $response = $this->execute($data);
        } catch (ApiException $exception) {
            throw ApiException::create($exception->getRequest(), $exception->getResponse());
        }

        $result = json_decode($response->getBody(), true);

        $token = new Token($result[static::ACCESS_TOKEN], $result[static::EXPIRES_IN], $result[static::SCOPE]);
        $token->setValidTo(new \DateTime('now +' . $result[static::EXPIRES_IN] . ' seconds'));
        if (isset($result[static::REFRESH_TOKEN])) {
            $token->setRefreshToken($result[static::REFRESH_TOKEN]);
        }

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
