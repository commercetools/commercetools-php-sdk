<?php

namespace Commercetools\Core\Client\OAuth;

use Cache\Adapter\Filesystem\FilesystemCachePool;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Message\RequestInterface;

class OAuth2Handler
{
    /**
     * @var TokenProvider
     */
    private $provider;
    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * OAuth2Handler constructor.
     * @param TokenProvider $provider
     * @param CacheItemPoolInterface $cache
     */
    public function __construct(TokenProvider $provider, CacheItemPoolInterface $cache = null)
    {
        $this->provider = $provider;
        if (is_null($cache)) {
            $filesystemAdapter = new Local(realpath(__DIR__ . '/../../../..'));
            $filesystem        = new Filesystem($filesystemAdapter);
            $cache = new FilesystemCachePool($filesystem);
        }
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

    /**
     * @return string
     */
    private function getBearerToken()
    {
        $item = null;
        if (!is_null($this->cache)) {
            $item = $this->cache->getItem(sha1('access_token'));
            if ($item->isHit()) {
                return (string)$item->get();
            }
        }

        $token = $this->provider->getToken();
        // ensure token to be invalidated in cache before TTL
        $ttl = max(1, floor($token->getTtl()/2));
        $this->saveToken($token->getToken(), $item, (int)$ttl);

        return $token->getToken();
    }

    /**
     * @param string $token
     * @param CacheItemInterface $item
     * @param int $ttl
     */
    private function saveToken($token, CacheItemInterface $item, $ttl)
    {
        if (!is_null($this->cache)) {
            $item->set($token);
            $item->expiresAfter($ttl);
            $this->cache->save($item);
        }
    }
}
