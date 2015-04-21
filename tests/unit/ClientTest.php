<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 29.01.15, 15:16
 */

namespace Sphere\Core;


use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Stream\BufferStream;
use GuzzleHttp\Subscriber\Mock;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Sphere\Core\Client\JsonEndpoint;
use Sphere\Core\Client\OAuth\Token;
use Sphere\Core\Request\ClientRequestInterface;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    protected function getConfig()
    {
        $config = new Config();
        $config->fromArray([
            Config::CLIENT_ID => 'id',
            Config::CLIENT_SECRET => 'secret',
            Config::OAUTH_URL => 'oauthUrl',
            Config::PROJECT => 'project',
            Config::API_URL => 'apiUrl'
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
        $oauthMock = $this->getMock('\Sphere\Core\Client\OAuth\Manager', ['getToken'], [$config]);
        $oauthMock->expects($this->any())
            ->method('getToken')
            ->will($this->returnValue(new Token('token')));

        $clientMock = $this->getMock('\Sphere\Core\Client', ['getOauthManager'], [$config, null, $logger]);
        $clientMock->expects($this->any())
            ->method('getOauthManager')
            ->will($this->returnValue($oauthMock));

        $responses = [];
        if (is_array($returnValue)) {
            foreach ($returnValue as $value) {
                $mockBody = new BufferStream();
                $mockBody->write($value);
                $responses[] = new Response($statusCode, $headers, $mockBody);
            }
        } else {
            $mockBody = new BufferStream();
            $mockBody->write($returnValue);
            $responses[] = new Response($statusCode, $headers, $mockBody);
        }

        $mock = new Mock($responses);
        // Add the mock subscriber to the client.
        $clientMock->getHttpClient()->getEmitter()->attach($mock);

        return $clientMock;
    }

    /**
     * @return ResponseInterface
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
     * @return ResponseInterface
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
    }

    /**
     * @expectedException \GuzzleHttp\Exception\ConnectException
     */
    public function testUnexpectedException()
    {
        $oauthMock = $this->getMock('\Sphere\Core\Client\OAuth\Manager', ['getToken'], [$this->getConfig()]);
        $oauthMock->expects($this->any())
            ->method('getToken')
            ->will($this->returnValue(new Token('token')));

        $clientMock = $this->getMock(
            '\Sphere\Core\Client',
            ['getOauthManager', 'createHttpRequest'],
            [$this->getConfig()]
        );
        $clientMock->expects($this->any())
            ->method('getOauthManager')
            ->will($this->returnValue($oauthMock));
        $httpRequest = $clientMock->getHttpClient()->createRequest('test');
        $clientMock->expects($this->any())
            ->method('createHttpRequest')
            ->will($this->returnValue($httpRequest));

        /**
         * @var Client $clientMock
         */
        $httpRequest = $clientMock->getHttpClient()->createRequest('test');

        $mock = new Mock();
        $mock->addException(new ConnectException('test', $httpRequest));
        // Add the mock subscriber to the client.
        $clientMock->getHttpClient()->getEmitter()->attach($mock);

        $endpoint = new JsonEndpoint('test');
        $request = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractFetchByIdRequest', [$endpoint, 'id']);

        $clientMock->execute($request);
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
        $this->assertSame('apiUrl/project/test/id', $record['context']['request']->getUrl());
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
        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $results[$request2->getIdentifier()]);
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
        $this->assertSame(Logger::NOTICE, $logEntry['level']);
        $this->assertSame('Call "test/id" with method "get" is deprecated: "Deprecated"', $logEntry['message']);
    }

    /**
     * @expectedException \Sphere\Core\Error\DeprecatedException
     */
    public function testLogDeprecatedException()
    {
        $client = $this->getMockClient(
            $this->getConfig(),
            $this->getSingleOpResult(),
            200,
            null,
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
    }

    /**
     * @expectedException \GuzzleHttp\Exception\ConnectException
     */
    public function testBatchException()
    {
        $oauthMock = $this->getMock('\Sphere\Core\Client\OAuth\Manager', ['getToken'], [$this->getConfig()]);
        $oauthMock->expects($this->any())
            ->method('getToken')
            ->will($this->returnValue(new Token('token')));

        $clientMock = $this->getMock(
            '\Sphere\Core\Client',
            ['getOauthManager', 'createHttpRequest'],
            [$this->getConfig()]
        );
        $clientMock->expects($this->any())
            ->method('getOauthManager')
            ->will($this->returnValue($oauthMock));
        $httpRequest = $clientMock->getHttpClient()->createRequest('test');
        $clientMock->expects($this->any())
            ->method('createHttpRequest')
            ->will($this->returnValue($httpRequest));

        /**
         * @var Client $clientMock
         */
        $httpRequest = $clientMock->getHttpClient()->createRequest('test');

        $mock = new Mock(['key' => 'value']);
        // Add the mock subscriber to the client.
        $clientMock->getHttpClient()->getEmitter()->attach($mock);

        $mock = new Mock(['key' => 'value']);
        $mock->addException(new ConnectException('test', $httpRequest));
        // Add the mock subscriber to the client.
        $clientMock->getHttpClient()->getEmitter()->attach($mock);

        $endpoint1 = new JsonEndpoint('test1');
        $request1 = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractQueryRequest', [$endpoint1]);
        $endpoint2 = new JsonEndpoint('test2');
        $request2 = $this->getMockForAbstractClass('\Sphere\Core\Request\AbstractFetchByIdRequest', [$endpoint2, 'id']);

        $clientMock->addBatchRequest($request1);
        $clientMock->addBatchRequest($request2);

        $clientMock->executeBatch();
    }
}
