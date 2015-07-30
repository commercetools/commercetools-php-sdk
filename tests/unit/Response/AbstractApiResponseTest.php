<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 10.02.15, 14:09
 */

namespace Commercetools\Core\Response;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\BufferStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Commercetools\Core\AccessorTrait;
use Commercetools\Core\Client\Adapter\Guzzle6Adapter;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Error\SphereException;
use Commercetools\Core\Request\AbstractApiRequest;

/**
 * Class AbstractApiResponseTest
 * @package Commercetools\Core\Response
 * @method AbstractApiRequest getRequest($class)
 */
class AbstractApiResponseTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_API_RESPONSE = '\Commercetools\Core\Response\AbstractApiResponse';
    const ABSTRACT_API_REQUEST = '\Commercetools\Core\Request\AbstractApiRequest';

    /**
     * @return Response
     */
    protected function getGuzzleResponse($response, $statusCode, $future = false, $headers = [])
    {
        if (version_compare(HttpClient::VERSION, '6.0.0', '>=')) {
            // Create a mock subscriber and queue two responses.
            $mockBody = new BufferStream();
            $mockBody->write($response);

            $mock = new MockHandler([
                new Response($statusCode, $headers, $mockBody)
            ]);

            $handler = HandlerStack::create($mock);
            // Add the mock subscriber to the client.
            $client = new Guzzle6Adapter(['handler' => $handler]);
        } else {
            $handler = new \GuzzleHttp\Ring\Client\MockHandler(
                ['status' => $statusCode, 'headers' => $headers, 'body' => $response]
            );

            $client = new \Commercetools\Core\Client\Adapter\Guzzle5Adapter(['handler' => $handler]);
        }

        $request = new Request(HttpMethod::GET, '/');
        if ($future) {
            $response = $client->executeAsync($request);
        } else {
            $response = $client->execute($request);
        }

        return $response;
    }

    /**
     * @return AbstractApiResponse
     */
    protected function getResponse($response = '{"key":"value"}', $statusCode = 200, $future = false, $headers = [])
    {
        try {
            $httpResponse = $this->getGuzzleResponse($response, $statusCode, $future, $headers);
        } catch (SphereException $e) {
            $httpResponse = $e->getResponse();
        }
        $response = $this->getMockForAbstractClass(
            static::ABSTRACT_API_RESPONSE,
            [
                $httpResponse,
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

        $this->assertInstanceOf('\Psr\Http\Message\ResponseInterface', $response->getResponse());
    }

    public function testRequest()
    {
        $response = $this->getResponse();

        $this->assertInstanceOf('\Commercetools\Core\Request\ClientRequestInterface', $response->getRequest());
    }


    public function testToObject()
    {
        $response = $this->getResponse();
        $this->assertInstanceOf('\Commercetools\Core\Model\Common\JsonObject', $response->toObject());
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
    public function testWaitFail()
    {
        $response = $this->getResponse('{"key":"value"}');
        $response->wait();
    }

    public function testThen()
    {
        $response = $this->getResponse('{"key":"value"}', 200, true);
        $this->assertInstanceOf('\Commercetools\Core\Response\ApiResponseInterface', $response->then());
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
        $this->assertSame(['bar'], $response->getHeader('foo'));
    }

    public function testHeaders()
    {
        $response = $this->getResponse('{"key":"value"}', 200, false, ['foo' => 'bar']);
        $this->assertSame(['foo' => ['bar']], $response->getHeaders());
    }
}
