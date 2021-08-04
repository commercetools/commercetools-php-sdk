<?php

namespace Commercetools\Core\Client;

use Commercetools\Core\Client;

class UserAgentProvider
{
    private $userAgent;

    /**
     * UserAgentProvider constructor.
     * @param string $userAgent
     */
    public function __construct($userAgent = null)
    {
        if (is_null($userAgent)) {
            $userAgent = 'commercetools-sdk-PHP-V1-' . Client::VERSION;
        }
        $this->userAgent = $userAgent;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }
}
