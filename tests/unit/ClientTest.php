<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 29.01.15, 15:16
 */

namespace Commercetools\Core;

use Commercetools\Core\Client\OAuth\Manager;
use Commercetools\Core\Error\BadGatewayException;
use Commercetools\Core\Error\ConcurrentModificationException;
use Commercetools\Core\Error\ErrorResponseException;
use Commercetools\Core\Error\GatewayTimeoutException;
use Commercetools\Core\Error\InternalServerErrorException;
use Commercetools\Core\Error\InvalidClientCredentialsException;
use Commercetools\Core\Error\InvalidTokenException;
use Commercetools\Core\Error\NotFoundException;
use Commercetools\Core\Error\ServiceUnavailableException;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Response\ErrorResponse;
use Commercetools\Core\Response\PagedQueryResponse;
use Commercetools\Core\Response\ResourceResponse;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Subscriber\History;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Commercetools\Core\Client\JsonEndpoint;
use Commercetools\Core\Client\OAuth\Token;
use Commercetools\Core\Request\ClientRequestInterface;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    protected function getConfig()
    {
        $config = Config::fromArray([
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
        $oauthMockBuilder = $this->getMockBuilder(Manager::class);
        $oauthMockBuilder->setMethods(['getToken', 'refreshToken'])->setConstructorArgs([$config]);
        $oauthMock = $oauthMockBuilder->getMock();

        $oauthMock->expects($this->any())
            ->method('getToken')
            ->will($this->returnValue(new Token('token')));
        $oauthMock->expects($this->any())
            ->method('refreshToken')
            ->will($this->returnValue(new Token('token')));

        $clientMockBuilder = $this->getMockBuilder(Client::class);
        $clientMockBuilder->setMethods(['getOauthManager'])->setConstructorArgs([$config, null, $logger]);
        $clientMock = $clientMockBuilder->getMock();
        
        $clientMock->expects($this->any())
            ->method('getOauthManager')
            ->will($this->returnValue($oauthMock));

        if (version_compare(HttpClient::VERSION, '6.0.0', '>=')) {
            $mockBodyClass = '\GuzzleHttp\Psr7\BufferStream';
            $mockFactory = false;
            $responseClass = '\GuzzleHttp\Psr7\Response';
        } else {
            $mockBodyClass = '\GuzzleHttp\Stream\Stream';
            $mockFactory = 'factory';
            $responseClass = '\GuzzleHttp\Message\Response';
        }

        $responses = [];
        if (is_array($returnValue)) {
            foreach ($returnValue as $value) {
                if ($mockFactory) {
                    $mockBody = $mockBodyClass::$mockFactory($value);
                } else {
                    $mockBody = new $mockBodyClass();
                    $mockBody->write($value);
                }
                $responses[] = new $responseClass($statusCode, $headers, $mockBody);
            }
        } else {
            if ($mockFactory) {
                $mockBody = $mockBodyClass::$mockFactory($returnValue);
            } else {
                $mockBody = new $mockBodyClass();
                $mockBody->write($returnValue);
            }
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
        $request = $this->getMockForAbstractClass(AbstractQueryRequest::class, [$endpoint]);

        $client = $this->getMockClient($this->getConfig(), $this->getQueryResult());
        $response = $client->execute($request);
        $this->assertInstanceOf(PagedQueryResponse::class, $response);
        $this->assertJsonStringEqualsJsonString($this->getQueryResult(), json_encode($response->toArray()));
    }

    public function testExecuteSingleOp()
    {
        $endpoint = new JsonEndpoint('test');
        $request = $this->getMockForAbstractClass(
            AbstractByIdGetRequest::class,
            [$endpoint, 'id']
        );

        $client = $this->getMockClient($this->getConfig(), $this->getSingleOpResult());
        $response = $client->execute($request);
        $this->assertInstanceOf(ResourceResponse::class, $response);
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
        $this->assertInstanceOf(Manager::class, $client->getOauthManager());
    }

    public function testException()
    {
        $endpoint = new JsonEndpoint('test');
        $request = $this->getMockForAbstractClass(
            AbstractByIdGetRequest::class,
            [$endpoint, 'id']
        );

        $client = $this->getMockClient($this->getConfig(), '', 500);
        $response = $client->execute($request);
        $this->assertInstanceOf(ErrorResponse::class, $response);
        $this->assertTrue($response->isError());
    }

    /**
     * @expectedException \Commercetools\Core\Error\ApiException
     */
    public function testUnexpectedException()
    {
        $oauthMockBuilder = $this->getMockBuilder(Manager::class);
        $oauthMockBuilder->setMethods(['getToken'])->setConstructorArgs([$this->getConfig()]);
        $oauthMock = $oauthMockBuilder->getMock();

        $oauthMock->expects($this->any())
            ->method('getToken')
            ->will($this->returnValue(new Token('token')));

        $clientMockBuilder = $this->getMockBuilder(Client::class);
        $clientMockBuilder->setMethods(['getOauthManager'])->setConstructorArgs([$this->getConfig()]);
        $clientMock = $clientMockBuilder->getMock();
        $clientMock->expects($this->any())
            ->method('getOauthManager')
            ->will($this->returnValue($oauthMock));

        /**
         * @var Client $clientMock
         */
        $endpoint = new JsonEndpoint('test');
        $request = $this->getMockForAbstractClass(
            AbstractByIdGetRequest::class,
            [$endpoint, 'id']
        );

        $clientMock->execute($request);
    }

    public function testExceptionWithResponse()
    {
        $config = $this->getConfig();

        $oauthMockBuilder = $this->getMockBuilder(Manager::class);
        $oauthMockBuilder->setMethods(['getToken'])->setConstructorArgs([$this->getConfig()]);
        $oauthMock = $oauthMockBuilder->getMock();
        $oauthMock->expects($this->any())
            ->method('getToken')
            ->will($this->returnValue(new Token('token')));

        $clientMockBuilder = $this->getMockBuilder(Client::class);
        $clientMockBuilder->setMethods(['getOauthManager'])->setConstructorArgs([$this->getConfig()]);
        $clientMock = $clientMockBuilder->getMock();
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
        $request = $this->getMockForAbstractClass(
            AbstractByIdGetRequest::class,
            [$endpoint, 'id']
        );

        $response = $clientMock->execute($request);

        $this->assertInstanceOf(ErrorResponse::class, $response);
        $this->assertTrue($response->isError());
    }

    public function testLogger()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $client = $this->getMockClient($this->getConfig(), $this->getSingleOpResult(), 200, $logger);

        $endpoint = new JsonEndpoint('test');
        $request = $this->getMockForAbstractClass(
            AbstractByIdGetRequest::class,
            [$endpoint, 'id']
        );
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
        $request = $this->getMockForAbstractClass(
            AbstractByIdGetRequest::class,
            [$endpoint, 'id']
        );
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
        $request1 = $this->getMockForAbstractClass(AbstractQueryRequest::class, [$endpoint1]);
        $endpoint2 = new JsonEndpoint('test2');
        $request2 = $this->getMockForAbstractClass(
            AbstractByIdGetRequest::class,
            [$endpoint2, 'id']
        );

        $client = $this->getMockClient($this->getConfig(), [$this->getQueryResult(), $this->getSingleOpResult()]);

        $client->addBatchRequest($request1);
        $client->addBatchRequest($request2);

        $results = $client->executeBatch();

        $this->assertInstanceOf(
            PagedQueryResponse::class,
            $results[$request1->getIdentifier()]
        );
        $this->assertFalse($results[$request1->getIdentifier()]->isError());
        $this->assertInstanceOf(ResourceResponse::class, $results[$request2->getIdentifier()]);
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
        $request = $this->getMockForAbstractClass(
            AbstractByIdGetRequest::class,
            [$endpoint, 'id']
        );
        $client->execute($request);

        $logEntry = $handler->getRecords()[1];
        $this->assertSame(Logger::WARNING, $logEntry['level']);
        $this->assertSame(
            'Call "test/id" with method "GET" is deprecated: "Deprecated"',
            (string)$logEntry['message']
        );
    }

    public function testLoggingBody()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $errorBody = '
        {
            "statusCode": 400,
            "message": "Some error",
            "errors": [
                {
                    "code": "InvalidOperation",
                    "message": "Some error"
                }
            ]
        }';
        $client = $this->getMockClient(
            $this->getConfig(),
            $errorBody,
            400,
            $logger
        );

        $endpoint = new JsonEndpoint('test');
        /**
         * @var ClientRequestInterface $request
         */
        $request = $this->getMockForAbstractClass(
            AbstractByIdGetRequest::class,
            [$endpoint, 'id']
        );
        $client->execute($request);

        $logEntry = $handler->getRecords()[1];
        $this->assertSame(Logger::ERROR, $logEntry['level']);
        $this->assertSame(
            'Client error response [url] test/id [status code] 400 [reason phrase] Bad Request',
            (string)$logEntry['message']
        );
        $this->assertJsonStringEqualsJsonString($errorBody, $logEntry['context']['responseBody']);
    }

    public function testLoggingBatchBody()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $errorBody = '
        {
            "statusCode": 400,
            "message": "Some error",
            "errors": [
                {
                    "code": "InvalidOperation",
                    "message": "Some error"
                }
            ]
        }';
        $client = $this->getMockClient(
            $this->getConfig(),
            $errorBody,
            400,
            $logger
        );

        $endpoint = new JsonEndpoint('test');
        /**
         * @var ClientRequestInterface $request
         */
        $request = $this->getMockForAbstractClass(
            AbstractByIdGetRequest::class,
            [$endpoint, 'id']
        );
        $client->addBatchRequest($request);
        $client->executeBatch();

        $logEntry = $handler->getRecords()[1];
        $this->assertSame(Logger::ERROR, $logEntry['level']);
        $this->assertSame(
            'Client error response [url] test/id [status code] 400 [reason phrase] Bad Request',
            (string)$logEntry['message']
        );
        $this->assertJsonStringEqualsJsonString($errorBody, $logEntry['context']['responseBody']);
    }
    /**
     * @expectedException \Commercetools\Core\Error\ApiException
     */
    public function testBatchException()
    {
        $oauthMockBuilder = $this->getMockBuilder(Manager::class);
        $oauthMockBuilder->setMethods(['getToken'])->setConstructorArgs([$this->getConfig()]);
        $oauthMock = $oauthMockBuilder->getMock();
        $oauthMock->expects($this->any())
            ->method('getToken')
            ->will($this->returnValue(new Token('token')));

        $clientMockBuilder = $this->getMockBuilder(Client::class);
        $clientMockBuilder->setMethods(['getOauthManager'])->setConstructorArgs([$this->getConfig()]);
        $clientMock = $clientMockBuilder->getMock();
        $clientMock->expects($this->any())
            ->method('getOauthManager')
            ->will($this->returnValue($oauthMock));

        /**
         * @var Client $clientMock
         */
        $endpoint1 = new JsonEndpoint('test1');
        $request1 = $this->getMockForAbstractClass(
            AbstractQueryRequest::class,
            [$endpoint1]
        );
        $endpoint2 = new JsonEndpoint('test2');
        $request2 = $this->getMockForAbstractClass(
            AbstractByIdGetRequest::class,
            [$endpoint2, 'id']
        );

        $clientMock->addBatchRequest($request1);
        $clientMock->addBatchRequest($request2);

        $clientMock->executeBatch();
    }

    public function testBatchExceptionWithResponse()
    {
        $oauthMockBuilder = $this->getMockBuilder(Manager::class);
        $oauthMockBuilder->setMethods(['getToken'])->setConstructorArgs([$this->getConfig()]);
        $oauthMock = $oauthMockBuilder->getMock();
        $oauthMock->expects($this->any())
            ->method('getToken')
            ->will($this->returnValue(new Token('token')));

        $clientMockBuilder = $this->getMockBuilder(Client::class);
        $clientMockBuilder->setMethods(['getOauthManager'])->setConstructorArgs([$this->getConfig()]);
        $clientMock = $clientMockBuilder->getMock();
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
        $request1 = $this->getMockForAbstractClass(
            AbstractByIdGetRequest::class,
            [$endpoint1, 'id']
        );
        $endpoint2 = new JsonEndpoint('test2');
        $request2 = $this->getMockForAbstractClass(
            AbstractByIdGetRequest::class,
            [$endpoint2, 'id']
        );

        $clientMock->addBatchRequest($request1);
        $clientMock->addBatchRequest($request2);

        $results = $clientMock->executeBatch();

        $this->assertInstanceOf(ErrorResponse::class, $results[$request1->getIdentifier()]);
        $this->assertTrue($results[$request1->getIdentifier()]->isError());
        $this->assertInstanceOf(ErrorResponse::class, $results[$request2->getIdentifier()]);
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
        $request = $this->getMockForAbstractClass(
            AbstractByIdGetRequest::class,
            [$endpoint, 'id']
        );
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
            [400, ErrorResponseException::class, ''],
            [401, InvalidTokenException::class, ['invalid_token','invalid_token']],
            [401, InvalidClientCredentialsException::class, ''],
            [404, NotFoundException::class, ''],
            [409, ConcurrentModificationException::class, ''],
            [500, InternalServerErrorException::class, ''],
            [502, BadGatewayException::class, ''],
            [503, ServiceUnavailableException::class, ''],
            [504, GatewayTimeoutException::class, ''],
        ];
    }

    /**
     * @dataProvider exceptionsData
     * @param $returnCode
     * @param $exceptionClass
     * @param $returnBody
     * @expectedException \Commercetools\Core\Error\ApiException
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
        $request = $this->getMockForAbstractClass(AbstractQueryRequest::class, [$endpoint]);

        try {
            $client->execute($request);
        } catch (\Exception $e) {
            $this->assertInstanceOf($exceptionClass, $e);
            $this->assertSame($returnCode, $e->getCode());
            throw $e;
        }
    }

    public function testUserAgent()
    {
        $config = $this->getConfig();

        $oauthMockBuilder = $this->getMockBuilder(Manager::class);
        $oauthMockBuilder->setMethods(['getToken'])->setConstructorArgs([$this->getConfig()]);
        $oauthMock = $oauthMockBuilder->getMock();
        $oauthMock->expects($this->any())
            ->method('getToken')
            ->will($this->returnValue(new Token('token')));

        $clientMockBuilder = $this->getMockBuilder(Client::class);
        $clientMockBuilder->setMethods(['getOauthManager'])->setConstructorArgs([$this->getConfig()]);
        $clientMock = $clientMockBuilder->getMock();
        $clientMock->expects($this->any())
            ->method('getOauthManager')
            ->will($this->returnValue($oauthMock));

        $container = [];
        if (version_compare(HttpClient::VERSION, '6.0.0', '>=')) {
            $mock = new MockHandler([
                new Response(200, [], $this->getSingleOpResult())
            ]);
            $history = Middleware::history($container);
            $handler = HandlerStack::create($mock);
            $handler->push($history);
            $clientMock->getHttpClient(['handler' => $handler]);
        } else {
            $container = new History();
            $handler = new \GuzzleHttp\Ring\Client\MockHandler(['status' => 200, 'body' => $this->getSingleOpResult()]);
            $clientMock->getHttpClient(['handler' => $handler]);
            $clientMock->getHttpClient()->getEmitter()->attach($container);
        }
        $clientMock->getHttpClient(['handler' => $handler]);

        $endpoint = new JsonEndpoint('test');
        $request = $this->getMockForAbstractClass(
            AbstractByIdGetRequest::class,
            [$endpoint, 'id']
        );

        $response = $clientMock->execute($request);

        $this->assertInstanceOf(ResourceResponse::class, $response);
        /**
         * @var Request $request
         */
        foreach ($container as $entry) {
            $request = $entry['request'];
            $userAgent = $request->getHeader('user-agent');
            if (is_array($userAgent)) {
                $userAgent = current($userAgent);
            }
            $userAgent = explode(' ', $userAgent);
            
            $n = 0;
            $this->assertSame('commercetools-php-sdk/' . AbstractHttpClient::VERSION, $userAgent[$n++]);
            $this->assertSame('GuzzleHttp/' . HttpClient::VERSION, trim($userAgent[$n++], '();'));
            if (extension_loaded('curl') && function_exists('curl_version')) {
                $this->assertSame('curl/' . \curl_version()['version'],trim($userAgent[$n++], '();'));
            }
            $this->assertSame('PHP/' . PHP_VERSION, $userAgent[$n++]);


        }
    }
}
