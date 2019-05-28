<?php

namespace Commercetools\Core\Client\OAuth;

use Cache\Adapter\Filesystem\FilesystemCachePool;
use Commercetools\Core\Cache\CacheAdapterFactory;
use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Error\Message;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Message\RequestInterface;
use Psr\SimpleCache\CacheInterface;

class OAuth2Handler
{
    const TOKEN_CACHE_KEY = 'commercetools_io_access_token';

    /**
     * @var TokenProvider
     */
    private $provider;
    /**
     * @var CacheItemPoolInterface|CacheInterface
     */
    private $cache;

    private $cacheKey;

    /**
     * OAuth2Handler constructor.
     * @param TokenProvider $provider
     * @param CacheItemPoolInterface|CacheInterface $cache
     * @param CacheAdapterFactory|null $factory
     * @param string $cacheKey
     */
    public function __construct(
        TokenProvider $provider,
        $cache = null,
        CacheAdapterFactory $factory = null,
        $cacheKey = null
    ) {
        $this->provider = $provider;

        if (is_null($factory)) {
            $factory = new CacheAdapterFactory(__DIR__ . '/../../../..');
        }
        $cache = $factory->get($cache);

        if (is_null($cache)) {
            throw new InvalidArgumentException(Message::INVALID_CACHE_ADAPTER);
        }

        $this->cacheKey = self::TOKEN_CACHE_KEY . "_" . (!is_null($cacheKey) ? $cacheKey : sha1('access_token'));
        $this->cache = $cache;
    }

    /**
     * @param RequestInterface $request
     * @param array $options
     * @return RequestInterface
     */
    public function __invoke(RequestInterface $request, array $options = [])
    {
        return $request->withHeader('Authorization', $this->getAuthorizationHeader());
    }

    /**
     * @return string
     */
    public function getAuthorizationHeader()
    {
        return 'Bearer ' . $this->getBearerToken();
    }

    public function refreshToken()
    {
        $token = $this->provider->getToken();
        // ensure token to be invalidated in cache before TTL
        $ttl = max(1, floor($token->getTtl()/2));

        $this->cache($token, $ttl);

        return $token;
    }

    /**
     * @return string
     */
    private function getBearerToken()
    {
        $item = null;

        $token = $this->getCacheToken();
        if (!is_null($token)) {
            return $token;
        }

        return $this->refreshToken()->getToken();
    }

    private function getCacheToken()
    {
        $cache = $this->cache;
        if ($cache instanceof CacheInterface) {
            $var = $cache->get($this->cacheKey, null);
            return $var;
        } elseif ($cache instanceof CacheItemPoolInterface) {
            $item = $cache->getItem($this->cacheKey);
            if ($item->isHit()) {
                return $item->get();
            }
        }

        return null;
    }

    private function cache(Token $token, $ttl)
    {
        $cache = $this->cache;
        if ($cache instanceof CacheInterface) {
            $cache->set($this->cacheKey, $token->getToken(), (int)$ttl);
        } elseif ($cache instanceof CacheItemPoolInterface) {
            $item = $cache->getItem($this->cacheKey)->set($token->getToken())->expiresAfter((int)$ttl);
            $cache->save($item);
        }
    }
}
