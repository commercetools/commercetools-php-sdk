<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 29.01.15, 15:16
 */

namespace Sphere\Core;


use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Sphere\Core\Client\JsonEndpoint;
use Sphere\Core\Client\OAuth\Token;
use Sphere\Core\Error\SphereException;
use Sphere\Core\Request\ClientRequestInterface;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    protected function getConfig()
    {
        $config = new Config();
        $config->fromArray([
            Config::CLIENT_ID => 'id',
            Config::CLIENT_SECRET => 'secret',
            Config::OAUTH_URL => 'http://oauthUrl',
            Config::PROJECT => 'project',
            Config::API_URL => 'http://apiUrl'
        ]);
        return $config;
    }

    /**
     * @param $config
     * @param $returnValue
     * @param int $statusCode
     * @param $logger
     * @param array $headers
     * @return Client
     */
    protected function getMockClient($config, $returnValue, $statusCode = 200, $logger = null, $headers = [])
    {
        $oauthMock = $this->getMock('\Sphere\Core\Client\OAuth\Manager', ['getToken', 'refreshToken'], [$config]);
        $oauthMock->expects($this->any())
            ->method('getToken')
            ->will($this->returnValue(new Token('token')));
        $oauthMock->expects($this->any())
            ->method('refreshToken')
            ->will($this->returnValue(new Token('token')));

        $clientMock = $this->getMock('\Sphere\Core\Client', ['getOauthManager'], [$config, null, $logger]);
        $clientMock->expects($this->any())
            ->method('getOauthManager')
            ->will($this->returnValue($oauthMock));

        if (version_compare(HttpClient::VERSION, '6.0.0', '>=')) {
            $mockBodyClass = '\GuzzleHttp\Psr7\BufferStream';
            $responseClass = '\GuzzleHttp\Psr7\Response';
        } else {
            $mockBodyClass = '\GuzzleHttp\Stream\BufferStream';
            $responseClass = '\GuzzleHttp\Message\Response';
        }

        $responses = [];
        if (is_array($returnValue)) {
            foreach ($returnValue as $value) {
                $mockBody = new $mockBodyClass();
                $mockBody->write($value);
                $responses[] = new $responseClass($statusCode, $headers, $mockBody);
            }
        } else {
            $mockBody = new $mockBodyClass();
            $mockBody->write($returnValue);
            $responses[] = new $responseClass($statusCode, $headers, $mockBody);
        }

        if (version_compare(HttpClient::VERSION, '6.0.0', '>=')) {
            $mock = new MockHandler($responses);

            $handler = HandlerStack::create($mock);
            // Add the mock subscriber to the client.
            $clientMock->getHttpClient(['handler' => $handler]);
        } else {
            $mock = new \GuzzleHttp\Subscriber\Mock($responses);
            // Add the mock subscriber to the client.
            $clientMock->getHttpClient()->getEmitter()->attach($mock);
        }

        return $clientMock;
    }

    /**
     * @return string
     */
    protected function getQueryResult()
    {
        return json_encode([
            'count' => 1,
            'total' => 1,
            'offset' => 0,
            'results' => [
                [
                    'key' => 'value'
                ]
            ]
        ]);
    }

    /**
     * @return string
     */
    protected function getSingleOpResult()
    {
        return json_encode(['key' => 'value']);
    }

    public function testExecuteQuery()
    {
        $endpoint = new JsonEndpoint('test');
        $request = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractQueryRequest', [$endpoint]);

        $client = $this->getMockClient($this->getConfig(), $this->getQueryResult());
        $response = $client->execute($request);
        $this->assertInstanceOf('\Sphere\Core\Response\PagedQueryResponse', $response);
        $this->assertJsonStringEqualsJsonString($this->getQueryResult(), json_encode($response->toArray()));
    }

    public function testExecuteSingleOp()
    {
        $endpoint = new JsonEndpoint('test');
        $request = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractFetchByIdRequest', [$endpoint, 'id']);

        $client = $this->getMockClient($this->getConfig(), $this->getSingleOpResult());
        $response = $client->execute($request);
        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
    }

    public function testApiUrl()
    {
        $client = new Client($this->getConfig());

        // change visibility of getBaseUrl
        $class = new \ReflectionClass($client);
        $method = $class->getMethod('getBaseUrl');
        $method->setAccessible(true);
        $output = $method->invoke($client);

        $this->assertSame($this->getConfig()->getApiUrl() . '/' . $this->getConfig()->getProject() . '/', $output);
    }

    public function testOAuthManager()
    {
        $client = new Client($this->getConfig());
        $this->assertInstanceOf('\Sphere\Core\Client\OAuth\Manager', $client->getOauthManager());
    }

    public function testException()
    {
        $endpoint = new JsonEndpoint('test');
        $request = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractFetchByIdRequest', [$endpoint, 'id']);

        $client = $this->getMockClient($this->getConfig(), '', 500);
        $response = $client->execute($request);
        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
        $this->assertTrue($response->isError());
    }

    /**
     * @expectedException \Sphere\Core\Error\SphereException
     */
    public function testUnexpectedException()
    {
        $oauthMock = $this->getMock('\Sphere\Core\Client\OAuth\Manager', ['getToken'], [$this->getConfig()]);
        $oauthMock->expects($this->any())
            ->method('getToken')
            ->will($this->returnValue(new Token('token')));

        $clientMock = $this->getMock(
            '\Sphere\Core\Client',
            ['getOauthManager'],
            [$this->getConfig()]
        );
        $clientMock->expects($this->any())
            ->method('getOauthManager')
            ->will($this->returnValue($oauthMock));

        /**
         * @var Client $clientMock
         */
        $endpoint = new JsonEndpoint('test');
        $request = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractFetchByIdRequest', [$endpoint, 'id']);

        $response = $clientMock->execute($request);
    }

    public function testExceptionWithResponse()
    {
        $config = $this->getConfig();

        $oauthMock = $this->getMock('\Sphere\Core\Client\OAuth\Manager', ['getToken'], [$this->getConfig()]);
        $oauthMock->expects($this->any())
            ->method('getToken')
            ->will($this->returnValue(new Token('token')));

        $clientMock = $this->getMock(
            '\Sphere\Core\Client',
            ['getOauthManager'],
            [$config]
        );
        $clientMock->expects($this->any())
            ->method('getOauthManager')
            ->will($this->returnValue($oauthMock));


        if (version_compare(HttpClient::VERSION, '6.0.0', '>=')) {
            $mock = new MockHandler([
                new Response(500, [], $this->getSingleOpResult())
            ]);
            $handler = HandlerStack::create($mock);
        } else {
            $handler = new \GuzzleHttp\Ring\Client\MockHandler(['status' => 500, 'body' => $this->getSingleOpResult()]);
        }
        $clientMock->getHttpClient(['handler' => $handler]);

        $endpoint = new JsonEndpoint('test');
        $request = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractFetchByIdRequest', [$endpoint, 'id']);

        $response = $clientMock->execute($request);

        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
        $this->assertTrue($response->isError());
    }

    public function testLogger()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $client = $this->getMockClient($this->getConfig(), $this->getSingleOpResult(), 200, $logger);

        $endpoint = new JsonEndpoint('test');
        $request = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractFetchByIdRequest', [$endpoint, 'id']);
        $client->execute($request);

        $record = current($handler->getRecords());

        $this->assertTrue($handler->hasInfo($record));
        $this->assertContains('GET /project/test/id', (string)$record['message']);
        $this->assertSame(200, $record['level']);
    }

    public function testFutureLogger()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $client = $this->getMockClient($this->getConfig(), $this->getSingleOpResult(), 200, $logger);

        $endpoint = new JsonEndpoint('test');
        $request = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractFetchByIdRequest', [$endpoint, 'id']);
        $response = $client->executeAsync($request);

        $this->assertFalse($response->isError());

        $record = current($handler->getRecords());
        $this->assertTrue($handler->hasInfo($record));
        $this->assertContains('GET /project/test/id', (string)$record['message']);
        $this->assertSame(200, $record['level']);
    }

    public function testBatch()
    {
        $endpoint1 = new JsonEndpoint('test1');
        $request1 = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractQueryRequest', [$endpoint1]);
        $endpoint2 = new JsonEndpoint('test2');
        $request2 = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractFetchByIdRequest', [$endpoint2, 'id']);

        $client = $this->getMockClient($this->getConfig(), [$this->getQueryResult(), $this->getSingleOpResult()]);

        $client->addBatchRequest($request1);
        $client->addBatchRequest($request2);

        $results = $client->executeBatch();

        $this->assertInstanceOf('\Sphere\Core\Response\PagedQueryResponse', $results[$request1->getIdentifier()]);
        $this->assertFalse($results[$request1->getIdentifier()]->isError());
        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $results[$request2->getIdentifier()]);
        $this->assertFalse($results[$request2->getIdentifier()]->isError());
    }

    public function testLogDeprecatedMethod()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $client = $this->getMockClient(
            $this->getConfig(),
            $this->getSingleOpResult(),
            200,
            $logger,
            [
                Client::DEPRECATION_HEADER => 'Deprecated'
            ]
        );

        $endpoint = new JsonEndpoint('test');
        /**
         * @var ClientRequestInterface $request
         */
        $request = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractFetchByIdRequest', [$endpoint, 'id']);
        $client->execute($request);

        $logEntry = $handler->getRecords()[1];
        $this->assertSame(Logger::WARNING, $logEntry['level']);
        $this->assertSame(
            'Call "test/id" with method "GET" is deprecated: "Deprecated"',
            (string)$logEntry['message']
        );
    }

    /**
     * @expectedException \GuzzleHttp\Exception\ConnectException
     */
    public function testBatchException()
    {
        $this->markTestSkipped('todo fix segfault');
        return;
        $oauthMock = $this->getMock('\Sphere\Core\Client\OAuth\Manager', ['getToken'], [$this->getConfig()]);
        $oauthMock->expects($this->any())
            ->method('getToken')
            ->will($this->returnValue(new Token('token')));

        $clientMock = $this->getMock(
            '\Sphere\Core\Client',
            ['getOauthManager'],
            [$this->getConfig()]
        );
        $clientMock->expects($this->any())
            ->method('getOauthManager')
            ->will($this->returnValue($oauthMock));

        /**
         * @var Client $clientMock
         */
        $endpoint1 = new JsonEndpoint('test1');
        $request1 = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractQueryRequest', [$endpoint1]);
        $endpoint2 = new JsonEndpoint('test2');
        $request2 = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractFetchByIdRequest', [$endpoint2, 'id']);

        $clientMock->addBatchRequest($request1);
        $clientMock->addBatchRequest($request2);

        $clientMock->executeBatch();
    }

    public function testBatchExceptionWithResponse()
    {
        $this->markTestSkipped('todo fix segfault');
        return;
        $oauthMock = $this->getMock('\Sphere\Core\Client\OAuth\Manager', ['getToken'], [$this->getConfig()]);
        $oauthMock->expects($this->any())
            ->method('getToken')
            ->will($this->returnValue(new Token('token')));

        $clientMock = $this->getMock(
            '\Sphere\Core\Client',
            ['getOauthManager'],
            [$this->getConfig()]
        );
        $clientMock->expects($this->any())
            ->method('getOauthManager')
            ->will($this->returnValue($oauthMock));

        if (version_compare(HttpClient::VERSION, '6.0.0', '>=')) {
            $mock = new MockHandler([
                new Response(500, [], $this->getSingleOpResult()),
                new Response(500)
            ]);
            $handler = HandlerStack::create($mock);
        } else {
            $handler = new \GuzzleHttp\Ring\Client\MockHandler(['status' => 500, 'body' => $this->getSingleOpResult()]);
        }
        $clientMock->getHttpClient(['handler' => $handler]);

        /**
         * @var Client $clientMock
         */
        $endpoint1 = new JsonEndpoint('test1');
        $request1 = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractFetchByIdRequest', [$endpoint1, 'id']);
        $endpoint2 = new JsonEndpoint('test2');
        $request2 = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractFetchByIdRequest', [$endpoint2, 'id']);

        $clientMock->addBatchRequest($request1);
        $clientMock->addBatchRequest($request2);

        $results = $clientMock->executeBatch();

        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $results[$request1->getIdentifier()]);
        $this->assertTrue($results[$request1->getIdentifier()]->isError());
        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $results[$request2->getIdentifier()]);
        $this->assertTrue($results[$request2->getIdentifier()]->isError());

    }

    public function testFutureLogDeprecatedMethod()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $client = $this->getMockClient(
            $this->getConfig(),
            $this->getSingleOpResult(),
            200,
            $logger,
            [
                Client::DEPRECATION_HEADER => 'Deprecated'
            ]
        );

        $endpoint = new JsonEndpoint('test');
        /**
         * @var ClientRequestInterface $request
         */
        $request = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractFetchByIdRequest', [$endpoint, 'id']);
        $response = $client->executeAsync($request);

        $this->assertFalse($response->isError());

        $logEntry = $handler->getRecords()[1];
        $this->assertSame(Logger::WARNING, $logEntry['level']);
        $this->assertSame(
            'Call "test/id" with method "GET" is deprecated: "Deprecated"',
            $logEntry['message']
        );
    }

    public function exceptionsData()
    {
        return [
            [400, '\Sphere\Core\Error\ErrorResponseException', ''],
            [401, '\Sphere\Core\Error\InvalidTokenException', ['invalid_token','invalid_token']],
            [401, '\Sphere\Core\Error\InvalidClientCredentialsException', ''],
            [404, '\Sphere\Core\Error\NotFoundException', ''],
            [409, '\Sphere\Core\Error\ConcurrentModificationException', ''],
            [500, '\Sphere\Core\Error\InternalServerErrorException', ''],
            [502, '\Sphere\Core\Error\BadGatewayException', ''],
            [503, '\Sphere\Core\Error\ServiceUnavailableException', ''],
            [504, '\Sphere\Core\Error\GatewayTimeoutException', ''],
        ];
    }

    /**
     * @dataProvider exceptionsData
     * @param $returnCode
     * @param $exceptionClass
     * @param $returnBody
     * @expectedException \Sphere\Core\Error\SphereException
     */
    public function testExceptions($returnCode, $exceptionClass, $returnBody)
    {
        $client = $this->getMockClient(
            $this->getConfig(),
            $returnBody,
            $returnCode
        );
        $client->getConfig()->setThrowExceptions(true);

        $endpoint = new JsonEndpoint('test');
        /**
         * @var ClientRequestInterface $request
         */
        $request = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractQueryRequest', [$endpoint]);

        try {
            $client->execute($request);
        } catch (\Exception $e) {
            $this->assertInstanceOf($exceptionClass, $e);
            $this->assertSame($returnCode, $e->getCode());
            throw $e;
        }
    }
}
