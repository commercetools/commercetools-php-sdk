<?php

namespace Commercetools\Core\Client\OAuth;

use Commercetools\Core\Cache\CacheAdapterFactory;
use Commercetools\Core\Error\InvalidArgumentException;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Message\RequestInterface;
use Psr\SimpleCache\CacheInterface;

class OAuth2Handler
{
    /**
     * @var TokenProvider
     */
    private $provider;

    /**
     * OAuth2Handler constructor.
     * @param TokenProvider $provider
     * @param CacheItemPoolInterface|CacheInterface $cache
     * @param CacheAdapterFactory|null $factory
     * @param string $cacheKey
     */
    public function __construct(
        TokenProvider $provider
    ) {
        $this->provider = $provider;
    }

    /**
     * @param RequestInterface $request
     * @param array $options
     * @return RequestInterface
     */
    public function __invoke(RequestInterface $request, array $options = [])
    {
        if ($request->hasHeader('Authorization')) {
            return $request;
        }
        return $request->withHeader('Authorization', $this->getAuthorizationHeader());
    }

    /**
     * @return string
     */
    public function getAuthorizationHeader()
    {
        return 'Bearer ' . $this->getBearerToken()->getToken();
    }

    public function refreshToken()
    {
        if ($this->provider instanceof RefreshTokenProvider) {
            return $this->provider->refreshToken();
        }
        throw new InvalidArgumentException();
    }

    /**
     * @return Token
     */
    private function getBearerToken()
    {
        return $this->provider->getToken();
    }

    /**
     * @return bool
     */
    public function refreshable()
    {
        return ($this->provider instanceof RefreshTokenProvider);
    }
}
