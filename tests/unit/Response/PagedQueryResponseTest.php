<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 10.02.15, 14:09
 */

namespace Commercetools\Core\Response;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\BufferStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Commercetools\Core\AccessorTrait;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Request\AbstractApiRequest;

/**
 * Class AbstractApiResponseTest
 * @package Commercetools\Core\Response
 * @method AbstractApiRequest getRequest($class)
 */
class PagedQueryResponseTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_API_REQUEST = '\Commercetools\Core\Request\AbstractApiRequest';

    const RESPONSE = '
    {
        "count": 1,
        "total": 1,
        "offset": 1,
        "results": [
            {
                "key": "value"
            }
        ]
    }';

    /**
     * @return Response
     */
    protected function getGuzzleResponse($response, $statusCode)
    {
        if (version_compare(HttpClient::VERSION, '6.0.0', '>=')) {
            // Create a mock subscriber and queue two responses.
            $mockBody = new BufferStream();
            $mockBody->write($response);

            $mock = new MockHandler([
                new Response($statusCode, [], $mockBody)
            ]);

            $handler = HandlerStack::create($mock);
            // Add the mock subscriber to the client.
            $client = new \Commercetools\Core\Client\Adapter\Guzzle6Adapter(['handler' => $mock]);
        } else {
            $handler = new \GuzzleHttp\Ring\Client\MockHandler(
                ['status' => $statusCode, 'body' => $response]
            );

            $client = new \Commercetools\Core\Client\Adapter\Guzzle5Adapter(['handler' => $handler]);
        }

        $request = new Request(HttpMethod::GET, '/');
        $response = $client->execute($request);

        return $response;
    }

    /**
     * @return PagedQueryResponse
     */
    protected function getResponse($response = null, $statusCode = 200)
    {
        if (is_null($response)) {
            $response = static::RESPONSE;
        }
        $response = new PagedQueryResponse(
            $this->getGuzzleResponse($response, $statusCode),
            $this->getRequest(static::ABSTRACT_API_REQUEST)
        );

        return $response;
    }

    public function testGetCount()
    {
        $response = $this->getResponse();

        $this->assertSame(1, $response->getCount());
    }

    public function testGetOffset()
    {
        $response = $this->getResponse();

        $this->assertSame(1, $response->getOffset());
    }

    public function testGetTotal()
    {
        $response = $this->getResponse();

        $this->assertSame(1, $response->getTotal());
    }

    public function testGetResults()
    {
        $response = $this->getResponse();

        $this->assertSame([['key' => 'value']], $response->getResults());
    }

    public function testGetEmptyResults()
    {
        $response = $this->getResponse('{
            "count": 0,
            "total": 0,
            "offset": 0
        }');

        $this->assertTrue(is_array($response->getResults()));
        $this->assertEmpty($response->getResults());
    }

    public function testIterator()
    {
        $response = $this->getResponse();

        foreach ($response as $data) {
            $this->assertSame(['key' => 'value'], $data);
        }
    }

    public function testExists()
    {
        $response = $this->getResponse();
        $this->assertTrue(isset($response[0]));
    }

    public function testGet()
    {
        $response = $this->getResponse();
        $this->assertSame(['key' => 'value'], $response[0]);
    }

    public function testSet()
    {
        $response = $this->getResponse();
        $response[1] = ['abc' => 'xyz'];
        $this->assertSame(['abc' => 'xyz'], $response->getResults()[1]);
    }

    public function testAppend()
    {
        $response = $this->getResponse();
        $response[] = ['abc' => 'xyz'];
        $this->assertSame(['abc' => 'xyz'], $response->getResults()[1]);
    }

    public function testUnset()
    {
        $response = $this->getResponse();
        unset($response[0]);
        $this->assertEmpty($response->getResults());
    }
}
