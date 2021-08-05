<?php

namespace Commercetools\Core\Client;

use Commercetools\Core\Client;
use GuzzleHttp\Client as HttpClient;

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
            $userAgent = 'commercetools-sdk-php-v1/' . Client::VERSION;

            $userAgent .= ' (' . $this->getAdapterInfo();
            if (extension_loaded('curl') && function_exists('curl_version')) {
                $userAgent .= '; curl/' . \curl_version()['version'];
            }
            $userAgent .= ') PHP/' . PHP_VERSION;
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

    private function getAdapterInfo()
    {
        if (defined('\GuzzleHttp\Client::MAJOR_VERSION')) {
            $clientVersion = (string) constant(HttpClient::class . '::MAJOR_VERSION');
        } else {
            $clientVersion = (string) constant(HttpClient::class . '::VERSION');
        }
        return 'GuzzleHttp/' . $clientVersion;
    }
}
