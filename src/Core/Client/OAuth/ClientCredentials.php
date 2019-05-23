<?php

namespace Commercetools\Core\Client\OAuth;

class ClientCredentials
{
    const CLIENT_ID = 'clientId';
    const CLIENT_SECRET = 'clientSecret';
    const SCOPE = 'scope';

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    private $scope;

    /**
     * @param array credentials
     */
    public function __construct(array $credentials = [])
    {
        $this->clientId = isset($credentials[self::CLIENT_ID]) ? $credentials[self::CLIENT_ID] : null;
        $this->clientSecret = isset($credentials[self::CLIENT_SECRET]) ? $credentials[self::CLIENT_SECRET] : null;
        $this->scope = isset($credentials[self::SCOPE]) ? $credentials[self::SCOPE] : null;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     * @return ClientCredentials
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param string $scope
     * @return ClientCredentials
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
        return $this;
    }


    /**
     * @param string $clientSecret
     * @return ClientCredentials
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }
}
