<?php

namespace Commercetools\Core\Client\OAuth;

class TokenStorageProvider implements RefreshTokenProvider
{
    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * @var AnonymousFlowTokenProvider;
     */
    private $anonymousProvider;

    /**
     * TokenStorageProvider constructor.
     * @param TokenStorage $tokenStorage
     * @param AnonymousFlowTokenProvider $anonymousProvider
     */
    public function __construct(TokenStorage $tokenStorage, AnonymousFlowTokenProvider $anonymousProvider)
    {
        $this->tokenStorage = $tokenStorage;
        $this->anonymousProvider = $anonymousProvider;
    }

    /**
     * @inheritDoc
     */
    public function refreshToken()
    {
        $token = $this->anonymousProvider->refreshToken();
        $this->storeToken($token);

        return $token;
    }

    /**
     * @inheritDoc
     */
    public function getToken()
    {
        $token = $this->tokenStorage->getAccessToken();
        if (!is_null($token)) {
            return new Token($token);
        }

        if ($this->tokenStorage->getRefreshToken()) {
            return $this->refreshToken();
        }

        $token = $this->anonymousProvider->getToken();
        $this->storeToken($token);

        return $token;
    }

    private function storeToken(Token $token)
    {
        $this->tokenStorage->setAccessToken($token->getToken());
        $this->tokenStorage->setRefreshToken($token->getRefreshToken());
    }
}
