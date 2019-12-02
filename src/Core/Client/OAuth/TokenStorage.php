<?php

namespace Commercetools\Core\Client\OAuth;

interface TokenStorage
{
    /**
     * @return string
     */
    public function getRefreshToken();

    /**
     * @return string
     */
    public function getAccessToken();

    /**
     * @param string $refreshToken
     * @return void
     */
    public function setRefreshToken($refreshToken);

    /**
     * @param string $accessToken
     * @return void
     */
    public function setAccessToken($accessToken);
}
