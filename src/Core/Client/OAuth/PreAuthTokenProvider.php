<?php

namespace Commercetools\Core\Client\OAuth;

class PreAuthTokenProvider implements TokenProvider
{
    /**
     * @var string
     */
    private $token;

    /**
     * @param string $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * @return Token
     */
    public function getToken()
    {
        return new Token($this->token);
    }
}
