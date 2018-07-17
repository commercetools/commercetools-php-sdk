<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Test\Functional;

use Commercetools\Core\AbstractHttpClient;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class HttpClientTest extends TestCase
{
    /**
     * @expectedException \GuzzleHttp\Exception\ConnectException
     */
    public function testTLSFail()
    {
        $headers = ['User-Agent' => $this->getUserAgent()];
        $client = new Client();
        $client->get(
            'https://api.escemo.com',
            $this->getOptions(
                [
                    'curl' => [
                        CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_1
                    ],
                    'headers' => $headers
                ]
            )
        );
    }

    public function testTLSForced1_2Success()
    {
        $client = new Client();
        $headers = ['User-Agent' => $this->getUserAgent()];
        $reponse = $client->get(
            'https://api.escemo.com',
            $this->getOptions(
                [
                    'curl' => [
                        CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2
                    ],
                    'headers' => $headers
                ]
            )
        );
        $this->assertSame(200, $reponse->getStatusCode());
    }


    public function testTLSSuccess()
    {
        $client = new Client();
        $headers = ['User-Agent' => $this->getUserAgent()];
        $reponse = $client->get(
            'https://api.escemo.com',
            $this->getOptions(
                [
                    'headers' => $headers
                ]
            )
        );
        $this->assertSame(200, $reponse->getStatusCode());
    }

    protected function getOptions(array $options = [])
    {
        if (version_compare(Client::VERSION, '6.0.0', '>=')) {
            return $options;
        }
        $config = [];
        if (isset($options['curl'])) {
            $config['config']['curl'] = $options['curl'];
        }
        if (isset($options['headers'])) {
            $config['headers'] = $options['headers'];
        }

        return $config;
    }

    protected function getUserAgent()
    {
        $agent = 'commercetools-php-sdk-tls/' . AbstractHttpClient::VERSION;

        $agent .= ' (Guzzle/' . Client::VERSION;
        if (extension_loaded('curl') && function_exists('curl_version')) {
            $agent .= '; curl/' . \curl_version()['version'];
        }
        $agent .= ') PHP/' . PHP_VERSION;
        return $agent;
    }
}
