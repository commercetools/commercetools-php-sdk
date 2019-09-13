<?php

namespace Commercetools\Core\Client;

use Commercetools\Core\Client\OAuth\AnonymousFlowTokenProvider;
use Commercetools\Core\Client\OAuth\AnonymousIdProvider;
use Commercetools\Core\Client\OAuth\ClientCredentials;
use Commercetools\Core\Client\OAuth\PasswordFlowTokenProvider;
use Commercetools\Core\Client\OAuth\RefreshFlowTokenProvider;
use Commercetools\Core\Client\OAuth\TokenStorage;
use Commercetools\Core\Client\OAuth\TokenStorageProvider;
use Commercetools\Core\Config;
use GuzzleHttp\Client;

class ProviderFactory
{
    public function createTokenStorageProviderFor(Config $config, Client $client, TokenStorage $storage, AnonymousIdProvider $anonymousIdProvider = null)
    {
        return $this->createTokenStorageProvider(
            $config->getOauthUrl(Config::GRANT_TYPE_ANONYMOUS),
            $config->getOauthUrl(Config::GRANT_TYPE_REFRESH),
            $config->getClientCredentials(),
            $client,
            $storage,
            $anonymousIdProvider
        );
    }

    public function createTokenStorageProvider(
        $anonTokenUrl,
        $refreshTokenUrl,
        ClientCredentials $credentials,
        Client $client,
        TokenStorage $storage,
        AnonymousIdProvider $anonymousIdProvider = null
    ) {
        $refreshTokenProvider = $this->createRefreshFlowProvider(
            $refreshTokenUrl,
            $credentials,
            $client,
            $storage
        );
        $anonProvider = $this->createAnonymousFlowProvider(
            $anonTokenUrl,
            $credentials,
            $client,
            $refreshTokenProvider,
            $anonymousIdProvider
        );
        return new TokenStorageProvider($storage, $anonProvider);
    }

    public function createPasswordFlowProviderFor(Config $config, Client $client, TokenStorage $storage)
    {
        return $this->createPasswordFlowProvider(
            $config->getOauthUrl(Config::GRANT_TYPE_PASSWORD),
            $config->getClientCredentials(),
            $client,
            $storage
        );
    }

    public function createPasswordFlowProvider(
        $passwordTokenUrl,
        ClientCredentials $credentials,
        Client $client,
        TokenStorage $storage
    ) {
        return new PasswordFlowTokenProvider($client, $passwordTokenUrl, $credentials, $storage);
    }

    public function createAnonymousFlowProvider(
        $anonTokenUrl,
        ClientCredentials $credentials,
        Client $client,
        RefreshFlowTokenProvider $refreshFlowTokenProvider,
        AnonymousIdProvider $anonymousIdProvider = null
    ) {
        return new AnonymousFlowTokenProvider($client, $anonTokenUrl, $credentials, $refreshFlowTokenProvider, $anonymousIdProvider);
    }

    public function createRefreshFlowProvider(
        $refreshTokenUrl,
        ClientCredentials $credentials,
        Client $client,
        TokenStorage $storage
    ) {
        return new RefreshFlowTokenProvider($client, $refreshTokenUrl, $credentials, $storage);
    }

    /**
     * @return ProviderFactory
     */
    public static function of()
    {
        return new static();
    }
}
