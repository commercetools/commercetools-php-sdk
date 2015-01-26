<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 22.01.15, 12:34
 */

namespace Sphere\Core\OAuth;


use Sphere\Core\AbstractHttpClient;
use Sphere\Core\Cache\CacheAdapterFactory;
use Sphere\Core\Cache\CacheAdapterInterface;
use Sphere\Core\Error\Message;
use Sphere\Core\Factory;

class Manager extends AbstractHttpClient
{
    const TOKEN_CACHE_KEY = 'sphere-io-access-token';

    const ACCESS_TOKEN = 'access_token';
    const EXPIRES_IN = 'expires_in';
    const ERROR = 'error';
    const ERROR_DESCRIPTION = 'error_description';

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
        if ($token = $this->getCacheAdapter()->fetch($this->getCacheKey($scope))) {
            return new Token($token);
        }
        $token = $this->getBearerToken($scope);
        // ensure token to be invalidated in cache before TTL
        $ttl = max(1, floor($token->getTtl()/2));
        $this->getCacheAdapter()->store($this->getCacheKey($scope), $token->getToken(), $ttl);

        return $token;
    }

    /**
     * @param $scope
     * @return string
     */
    protected function getCacheKey($scope)
    {
        if (!isset($this->cacheKeys[$scope])) {
            $this->cacheKeys[$scope] = static::TOKEN_CACHE_KEY . '-' . sha1($scope . '-' . $this->getConfig()->getProject());
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

        $result = $this->getHttpClient()->post(
            $this->getConfig()->getOauthUrl(),
            [
                'body' => $data,
                'auth' => [$this->getConfig()->getClientId(), $this->getConfig()->getClientSecret()]
            ]
        )->json();

        if (isset($result[static::ERROR])) {
            $message = isset($result[static::ERROR_DESCRIPTION]) ?
                $result[static::ERROR_DESCRIPTION] : $result[static::ERROR];
            throw new AuthorizeException(sprintf(Message::AUTHENTICATION_FAIL, $message));
        }

        $token = new Token($result[static::ACCESS_TOKEN], $result[static::EXPIRES_IN]);
        $token->setValidTo(new \DateTime('now +' . $result[static::EXPIRES_IN] . ' seconds'));

        return $token;
    }

    protected function getBaseUrl()
    {
        return $this->getConfig()->getOauthUrl();
    }
}
