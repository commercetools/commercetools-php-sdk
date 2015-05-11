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
class AbstractApiResponseTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_API_RESPONSE = '\Sphere\Core\Response\AbstractApiResponse';
    const ABSTRACT_API_REQUEST = '\Sphere\Core\Request\AbstractApiRequest';

    /**
     * @return Response
     */
    protected function getGuzzleResponse($response, $statusCode, $future = false, $headers = [])
    {
        $client = new HttpClient();
        // Create a mock subscriber and queue two responses.
        $mockBody = new BufferStream();
        $mockBody->write($response);

        $mock = new Mock([
            new Response($statusCode, $headers, $mockBody)
        ]);
        // Add the mock subscriber to the client.
        $client->getEmitter()->attach($mock);

        try {
            $guzzleResponse = $client->get('/', ['future' => $future]);
        } catch (RequestException $exception) {
            $guzzleResponse = $exception->getResponse();
        }

        return $guzzleResponse;
    }

    /**
     * @return AbstractApiResponse
     */
    protected function getResponse($response = '{"key":"value"}', $statusCode = 200, $future = false, $headers = [])
    {
        $response = $this->getMockForAbstractClass(
            static::ABSTRACT_API_RESPONSE,
            [
                $this->getGuzzleResponse($response, $statusCode, $future, $headers),
                $this->getRequest(static::ABSTRACT_API_REQUEST)
            ]
        );

        return $response;
    }

    public function testBody()
    {
        $response = $this->getResponse();

        $this->assertSame('{"key":"value"}', $response->getBody());
    }

    public function testJson()
    {
        $response = $this->getResponse();

        $this->assertSame(['key' => 'value'], $response->toArray());
    }

    public function testSuccess()
    {
        $response = $this->getResponse();

        $this->assertFalse($response->isError());
    }

    public function testError()
    {
        $response = $this->getResponse('{"key":"value"}', 500);

        $this->assertTrue($response->isError());
    }

    public function testResponse()
    {
        $response = $this->getResponse();

        $this->assertInstanceOf('\GuzzleHttp\Message\ResponseInterface', $response->getResponse());
    }

    public function testRequest()
    {
        $response = $this->getResponse();

        $this->assertInstanceOf('\Sphere\Core\Request\ClientRequestInterface', $response->getRequest());
    }


    public function testToObject()
    {
        $response = $this->getResponse();
        $this->assertInstanceOf('\Sphere\Core\Model\Common\JsonObject', $response->toObject());
    }

    public function testErrorToObject()
    {
        $response = $this->getResponse('{"key":"value"}', 500);
        $this->assertNull($response->toObject());
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testThenFail()
    {
        $response = $this->getResponse('{"key":"value"}');
        $response->then();
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testCancelFail()
    {
        $response = $this->getResponse('{"key":"value"}');
        $response->cancel();
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testWaitFail()
    {
        $response = $this->getResponse('{"key":"value"}');
        $response->wait();
    }

    public function testThen()
    {
        $response = $this->getResponse('{"key":"value"}', 200, true);
        $this->assertInstanceOf('\React\Promise\PromiseInterface', $response->then());
    }

    public function testCancel()
    {
        $response = $this->getResponse('{"key":"value"}', 200, true);
        $response->cancel();
        $this->assertTrue($response->isError());
    }

    public function testWait()
    {
        $response = $this->getResponse('{"key":"value"}', 200, true);
        $response->wait();
        $this->assertJsonStringEqualsJsonString('{"key":"value"}', json_encode($response->toObject()));
    }

    public function testHeader()
    {
        $response = $this->getResponse('{"key":"value"}', 200, false, ['foo' => 'bar']);
        $this->assertSame('bar', $response->getHeader('foo'));
    }

    public function testHeaders()
    {
        $response = $this->getResponse('{"key":"value"}', 200, false, ['foo' => 'bar']);
        $this->assertSame(['foo' => ['bar']], $response->getHeaders());
    }
}
