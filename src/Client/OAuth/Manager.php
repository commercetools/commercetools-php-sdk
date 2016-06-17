<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 22.01.15, 12:34
 */

namespace Commercetools\Core\Client\OAuth;

use Cache\Adapter\Common\CacheItem;
use Commercetools\Core\Config;
use Commercetools\Core\Error\ApiException;
use Psr\Cache\CacheItemPoolInterface;
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
    const TOKEN_CACHE_KEY = 'commercetools_io_access_token';

    const ANONYMOUS_ID = 'anonymous_id';
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
     * @var CacheAdapterInterface|CacheItemPoolInterface
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
            $this->cacheAdapterFactory = new CacheAdapterFactory($this->getConfig()->getCacheDir());
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
     * @internal will become protected in version 2.0
     * @return CacheAdapterInterface|CacheItemPoolInterface
     */
    public function getCacheAdapter()
    {
        return $this->cacheAdapter;
    }

    /**
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

        switch ($grantType) {
            case Config::GRANT_TYPE_PASSWORD:
                $user = $this->getConfig()->getUsername();
                $password = $this->getConfig()->getPassword();
                $data[Config::USER_NAME] = $user;
                $data[Config::PASSWORD] = $password;
                break;
            case Config::GRANT_TYPE_REFRESH:
                $refreshToken = $this->getConfig()->getRefreshToken();
                $data[Config::REFRESH_TOKEN] = $refreshToken;
                break;
            case Config::GRANT_TYPE_ANONYMOUS:
                $data[Config::GRANT_TYPE] = Config::GRANT_TYPE_CLIENT;
                $anonymousId = $this->getConfig()->getAnonymousId();
                if (!empty($anonymousId)) {
                    $data[Config::ANONYMOUS_ID] = $anonymousId;
                }
        }

        $token = $this->getBearerToken($data);

        // ensure token to be invalidated in cache before TTL
        $ttl = max(1, floor($token->getTtl()/2));

        $this->cache($token, $ttl);

        if ($grantType === Config::GRANT_TYPE_PASSWORD || $grantType == Config::GRANT_TYPE_ANONYMOUS) {
            $this->getConfig()->setGrantType(Config::GRANT_TYPE_REFRESH);
            $this->getConfig()->setRefreshToken($token->getRefreshToken());
            $this->cache($token, $ttl);
        }

        return $token;
    }

    protected function cache(Token $token, $ttl)
    {
        $cache = $this->getCacheAdapter();
        if ($cache instanceof CacheAdapterInterface) {
            $cache->store($this->getCacheKey(), $token->getToken(), (int)$ttl);
        }
        if ($cache instanceof CacheItemPoolInterface) {
            $item = new CacheItem($this->getCacheKey(), true, $token->getToken());
            $item->expiresAfter((int)$ttl);
            $cache->save($item);
        }
    }

    protected function getCacheToken()
    {
        $cache = $this->getCacheAdapter();
        if ($cache instanceof CacheAdapterInterface) {
            return $cache->fetch($this->getCacheKey());
        }
        if ($cache instanceof CacheItemPoolInterface) {
            $item = $cache->getItem($this->getCacheKey());
            if ($item->isHit()) {
                return $item->get();
            }
        }

        return false;
    }

    /**
     * @return string
     */
    protected function getCacheKey()
    {
        $scope = $this->getConfig()->getScope();
        $grantType = $this->getConfig()->getGrantType();
        $cacheScope = $scope . '-' . $grantType;

        switch ($grantType) {
            case Config::GRANT_TYPE_PASSWORD:
                $user = base64_encode($this->getConfig()->getUsername());
                $cacheScope .= '-' . $user;
                break;
            case Config::GRANT_TYPE_REFRESH:
                $token = $this->getConfig()->getRefreshToken();
                $cacheScope .= '-' . $token;
                break;
            case Config::GRANT_TYPE_ANONYMOUS:
                $anonymousId = $this->getConfig()->getAnonymousId();
                if (!empty($anonymousId)) {
                    $cacheScope .= '-' . $anonymousId;
                }
                break;
        }

        if (!isset($this->cacheKeys[$cacheScope])) {
            $this->cacheKeys[$cacheScope] = static::TOKEN_CACHE_KEY . '_' .
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
