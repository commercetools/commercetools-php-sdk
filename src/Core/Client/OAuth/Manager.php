<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 22.01.15, 12:34
 */

namespace Commercetools\Core\Client\OAuth;

use Commercetools\Core\Client\Adapter\CorrelationIdAware;
use Commercetools\Core\Config;
use Commercetools\Core\Error\ApiException;
use Commercetools\Core\Helper\CorrelationIdProvider;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\AbstractHttpClient;
use Commercetools\Core\Cache\CacheAdapterFactory;
use Commercetools\Core\Error\InvalidClientCredentialsException;
use Psr\SimpleCache\CacheInterface;

/**
 * @package Commercetools\Core\OAuth
 * @internal
 */
class Manager extends AbstractHttpClient implements TokenProvider
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
     * @var CacheItemPoolInterface|CacheInterface
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
     * @return CacheItemPoolInterface|CacheInterface
     */
    protected function getCacheAdapter()
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
        if ($this->getConfig()->getGrantType() == Config::GRANT_TYPE_BEARER_TOKEN) {
            return new Token($this->getConfig()->getBearerToken(), null, $scope);
        }
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
        $data = [Config::GRANT_TYPE => $grantType];
        if (!empty($scope)) {
            $data[Config::SCOPE] = $scope;
        }

        switch ($grantType) {
            case Config::GRANT_TYPE_BEARER_TOKEN:
                return new Token($this->getConfig()->getBearerToken(), null, $scope);
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
            $this->getConfig()->setRefreshToken($token->getRefreshToken());
            $this->cache($token, $ttl, $this->getCacheKey(Config::GRANT_TYPE_REFRESH));
        }

        return $token;
    }

    protected function cache(Token $token, $ttl, $cacheKey = null)
    {
        if (is_null($cacheKey)) {
            $cacheKey = $this->getCacheKey();
        }
        $cache = $this->getCacheAdapter();
        if ($cache instanceof CacheItemPoolInterface) {
            $item = $cache->getItem($cacheKey)->set($token->getToken())->expiresAfter((int)$ttl);
            $cache->save($item);
        }
        if ($cache instanceof CacheInterface) {
            $cache->set($cacheKey, $token->getToken(), (int)$ttl);
        }
    }

    protected function getCacheToken()
    {
        $cache = $this->getCacheAdapter();
        if ($cache instanceof CacheItemPoolInterface) {
            $item = $cache->getItem($this->getCacheKey());
            if ($item->isHit()) {
                return $item->get();
            }
        }
        if ($cache instanceof CacheInterface) {
            return $cache->get($this->getCacheKey(), false);
        }

        return false;
    }

    /**
     * @return string
     */
    protected function getCacheKey($grantType = null)
    {
        $scope = $this->getConfig()->getScope();
        if (is_null($grantType)) {
            $grantType = $this->getConfig()->getGrantType();
        }
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
     * @inheritDoc
     */
    public function getHttpClient($options = [])
    {
        if (is_null($this->httpClient)) {
            $clientOptions = $this->config->getOAuthClientOptions();
            if (count($clientOptions) > 0) {
                $options = array_merge($clientOptions, $options);
            }
            $client = parent::getHttpClient($options);
            if ($this->getConfig()->getCorrelationIdProvider() instanceof CorrelationIdProvider
                && $client instanceof CorrelationIdAware
            ) {
                $client->setCorrelationIdProvider($this->getConfig()->getCorrelationIdProvider());
            }
            $this->httpClient = $client;
        }
        return $this->httpClient;
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
