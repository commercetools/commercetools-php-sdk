<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 10.02.15, 14:09
 */

namespace Sphere\Core\Response;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\BufferStream;
use GuzzleHttp\Subscriber\Mock;
use Sphere\Core\AccessorTrait;
use Sphere\Core\Request\AbstractApiRequest;

/**
 * Class AbstractApiResponseTest
 * @package Sphere\Core\Response
 * @method AbstractApiRequest getRequest($class)
 */
class PagedQueryResponseTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_API_REQUEST = '\Sphere\Core\Request\AbstractApiRequest';

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
        $client = new HttpClient();
        // Create a mock subscriber and queue two responses.
        $mockBody = new BufferStream();
        $mockBody->write($response);

        $mock = new Mock([
            new Response($statusCode, [], $mockBody)
        ]);
        // Add the mock subscriber to the client.
        $client->getEmitter()->attach($mock);

        try {
            $guzzleResponse = $client->get('/');
        } catch (RequestException $exception) {
            $guzzleResponse = $exception->getResponse();
        }

        return $guzzleResponse;
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

    public function testUnset()
    {
        $response = $this->getResponse();
        unset($response[0]);
        $this->assertEmpty($response->getResults());
    }
}
