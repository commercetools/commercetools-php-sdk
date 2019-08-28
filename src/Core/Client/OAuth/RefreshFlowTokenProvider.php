<?php

namespace Commercetools\Core\Client\OAuth;

use GuzzleHttp\Client;

class RefreshFlowTokenProvider implements RefreshTokenProvider
{
    const GRANT_TYPE = 'grant_type';
    const GRANT_TYPE_REFRESH_TOKEN = 'refresh_token';
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
     * @var AnonymousFlowTokenProvider
     */
    private $anonymousFlowTokenProvider;

    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * @param Client $client
     * @param $accessTokenUrl
     * @param ClientCredentials $credentials
     * @param TokenStorage $tokenStorage
     */
    public function __construct(
        Client $client,
        $accessTokenUrl,
        ClientCredentials $credentials,
        TokenStorage $tokenStorage
    ) {
        $this->accessTokenUrl = $accessTokenUrl;
        $this->client = $client;
        $this->credentials = $credentials;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return Token
     */
    public function getToken()
    {
        return $this->refreshToken();
    }

    /**
     * @return Token
     */
    public function refreshToken()
    {
        $refreshToken = $this->tokenStorage->getRefreshToken();
        $data = [
            self::GRANT_TYPE => self::GRANT_TYPE_REFRESH_TOKEN,
            self::REFRESH_TOKEN => $refreshToken
        ];
        $options = [
            'form_params' => $data,
            'auth' => [$this->credentials->getClientId(), $this->credentials->getClientSecret()]
        ];

        $result = $this->client->post($this->accessTokenUrl, $options);

        $body = json_decode((string)$result->getBody(), true);
        $token = new Token((string)$body[self::ACCESS_TOKEN], (int)$body[self::EXPIRES_IN], $body[self::SCOPE]);
        $token->setRefreshToken($refreshToken);

        return $token;
    }
}
