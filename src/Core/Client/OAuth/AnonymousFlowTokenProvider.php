<?php

namespace Commercetools\Core\Client\OAuth;

use GuzzleHttp\Client;

class AnonymousFlowTokenProvider implements RefreshTokenProvider
{
    const GRANT_TYPE = 'grant_type';
    const GRANT_TYPE_CLIENT_CREDENTIALS = 'client_credentials';
    const SCOPE = 'scope';
    const REFRESH_TOKEN = 'refresh_token';
    const ACCESS_TOKEN = 'access_token';
    const EXPIRES_IN = 'expires_in';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var ClientCredentials
     */
    private $credentials;

    /**
     * @var string
     */
    private $accessTokenUrl;

    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * @var RefreshFlowTokenProvider
     */
    private $refreshTokenProvider;

    /**
     * @var AnonymousIdProvider
     */
    private $anonymousIdProvider;


    /**
     * @param Client $client
     * @param $accessTokenUrl
     * @param ClientCredentials $credentials
     * @param RefreshFlowTokenProvider $refreshTokenProvider
     * @param AnonymousIdProvider|null $anonymousIdProvider
     */
    public function __construct(
        Client $client,
        $accessTokenUrl,
        ClientCredentials $credentials,
        RefreshFlowTokenProvider $refreshTokenProvider,
        AnonymousIdProvider $anonymousIdProvider = null
    ) {
        $this->accessTokenUrl = $accessTokenUrl;
        $this->client = $client;
        $this->credentials = $credentials;
        $this->refreshTokenProvider = $refreshTokenProvider;
        $this->anonymousIdProvider = $anonymousIdProvider;
    }

    /**
     * @return Token
     */
    public function getToken()
    {
        $data = [
            self::GRANT_TYPE => self::GRANT_TYPE_CLIENT_CREDENTIALS,
        ];
        if ($this->anonymousIdProvider) {
            $data['anonymous_id'] = $this->anonymousIdProvider->getAnonymousId();
        }
        $options = [
            'form_params' => $data,
            'auth' => [$this->credentials->getClientId(), $this->credentials->getClientSecret()]
        ];

        $result = $this->client->post($this->accessTokenUrl, $options);

        $body = json_decode((string)$result->getBody(), true);
        $token = new Token((string)$body[self::ACCESS_TOKEN], (int)$body[self::EXPIRES_IN], $body[self::SCOPE]);
        $token->setRefreshToken((string)$body[self::REFRESH_TOKEN]);

        return $token;
    }

    /**
     * @inheritDoc
     */
    public function refreshToken()
    {
        return $this->refreshTokenProvider->refreshToken();
    }
}
