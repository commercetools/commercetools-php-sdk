<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Client\OAuth;

use Psr\Cache\CacheItemPoolInterface;
use Psr\SimpleCache\CacheInterface;

class CacheTokenProvider implements RefreshTokenProvider
{
    const TOKEN_CACHE_KEY = 'commercetools_io_access_token';

    /**
     * @var TokenProvider
     */
    private $tokenProvider;

    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    private $cacheKey;

    /**
     * CacheTokenProvider constructor.
     * @param TokenProvider $tokenProvider
     * @param CacheItemPoolInterface|CacheInterface $cache
     * @param string $cacheKey
     */
    public function __construct(RefreshTokenProvider $tokenProvider, $cache, $cacheKey = null)
    {
        $this->tokenProvider = $tokenProvider;
        $this->cache = $cache;
        $this->cacheKey = self::TOKEN_CACHE_KEY . "_" . (!is_null($cacheKey) ? $cacheKey : sha1('access_token'));
    }


    /**
     * @inheritDoc
     */
    public function getToken()
    {
        $item = null;

        $token = $this->getCacheToken();
        if (!is_null($token)) {
            return $token;
        }

        return $this->refreshToken();
    }

    /**
     * @inheritDoc
     */
    public function refreshToken()
    {
        $token = $this->tokenProvider->refreshToken();
        // ensure token to be invalidated in cache before TTL
        $ttl = max(1, floor($token->getTtl()/2));

        $this->cache($token, $ttl);

        return $token;
    }

    private function getCacheToken()
    {
        $cache = $this->cache;
        if ($cache instanceof CacheInterface) {
            $var = $cache->get($this->cacheKey, null);
            return new Token($var);
        } elseif ($cache instanceof CacheItemPoolInterface) {
            $item = $cache->getItem($this->cacheKey);
            if ($item->isHit()) {
                return new Token($item->get());
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
