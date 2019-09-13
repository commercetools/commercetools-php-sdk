<?php

namespace Commercetools\Core\Client\OAuth;

use GuzzleHttp\Client;

class PasswordFlowTokenProvider
{
    const GRANT_TYPE = 'grant_type';
    const GRANT_TYPE_PASSWORD = 'password';
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
     * @param string $userName
     * @param string $password
     * @return Token
     */
    public function getTokenFor($userName, $password)
    {
        $data = [
            self::GRANT_TYPE => self::GRANT_TYPE_PASSWORD,
            'username' => $userName,
            'password' => $password
        ];
        $options = [
            'form_params' => $data,
            'auth' => [$this->credentials->getClientId(), $this->credentials->getClientSecret()]
        ];

        $result = $this->client->post($this->accessTokenUrl, $options);

        $body = json_decode((string)$result->getBody(), true);
        $token = new Token((string)$body[self::ACCESS_TOKEN], (int)$body[self::EXPIRES_IN], $body[self::SCOPE]);
        $token->setRefreshToken((string)$body[self::REFRESH_TOKEN]);

        $this->tokenStorage->setAccessToken($token->getToken());
        $this->tokenStorage->setRefreshToken($token->getRefreshToken());

        return $token;
    }
}
