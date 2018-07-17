<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Test\Functional;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class HttpClientTest extends TestCase
{
    /**
     * @expectedException \GuzzleHttp\Exception\ConnectException
     */
    public function testTLSFail()
    {
        $client = new Client();
        $client->get(
            'https://api.escemo.com',
            [
                'curl' => [
                    CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_1
                ]
            ]
        );
    }

    public function testTLSSuccess()
    {
        $client = new Client();
        $reponse = $client->get(
            'https://api.escemo.com',
            [
                'curl' => [
                    CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2
                ]
            ]
        );
        $this->assertSame(200, $reponse->getStatusCode());
    }
}
