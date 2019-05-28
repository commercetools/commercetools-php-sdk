<?php

namespace Commercetools\Core\Client\OAuth;

use GuzzleHttp\Client;

class CredentialTokenProvider implements TokenProvider
{
    const GRANT_TYPE = 'grant_type';
    const GRANT_TYPE_CLIENT_CREDENTIALS = 'client_credentials';
    const SCOPE = 'scope';
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
     * @param Client $client
     * @param string $accessTokenUrl
     * @param array $credentials
     */
    public function __construct(Client $client, $accessTokenUrl, ClientCredentials $credentials)
    {
        $this->accessTokenUrl = $accessTokenUrl;
        $this->client = $client;
        $this->credentials = $credentials;
    }

    /**
     * @return Token
     */
    public function getToken()
    {
        $data = [
            self::GRANT_TYPE => self::GRANT_TYPE_CLIENT_CREDENTIALS
        ];
        if (!empty($this->credentials->getScope())) {
            $data[self::SCOPE] = $this->credentials->getScope();
        }
        $options = [
            'form_params' => $data,
            'auth' => [$this->credentials->getClientId(), $this->credentials->getClientSecret()]
        ];

        $result = $this->client->post($this->accessTokenUrl, $options);

        $body = json_decode((string)$result->getBody(), true);
        return new Token((string)$body[self::ACCESS_TOKEN], (int)$body[self::EXPIRES_IN], $body[self::SCOPE]);
    }
}
