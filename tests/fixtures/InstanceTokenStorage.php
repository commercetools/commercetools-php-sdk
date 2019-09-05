<?php

namespace Commercetools\Core\Fixtures;

use Commercetools\Core\Client\OAuth\TokenStorage;

class InstanceTokenStorage implements TokenStorage
{
    private $accessToken;
    private $refreshToken;

    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }
}
