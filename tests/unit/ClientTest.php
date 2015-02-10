<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 29.01.15, 15:16
 */

namespace Sphere\Core;


use GuzzleHttp\Message\Response;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Stream\BufferStream;
use GuzzleHttp\Subscriber\Mock;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Sphere\Core\Client\JsonEndpoint;
use Sphere\Core\Client\OAuth\Token;

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
     * @return Client
     */
    protected function getMockClient($config, $returnValue, $statusCode = 200, $logger = null)
    {
        $oauthMock = $this->getMock('\Sphere\Core\Client\OAuth\Manager', ['getToken'], [$config]);
        $oauthMock->expects($this->any())
            ->method('getToken')
            ->will($this->returnValue(new Token('token')));

        $clientMock = $this->getMock('\Sphere\Core\Client', ['getOauthManager'], [$config, null, $logger]);
        $clientMock->expects($this->any())
            ->method('getOauthManager')
            ->will($this->returnValue($oauthMock));

        if (is_array($returnValue)) {
            $returnValue = json_encode($returnValue);
        }
        $mockBody = new BufferStream();
        $mockBody->write($returnValue);

        $mock = new Mock([
            new Response($statusCode, [], $mockBody)
        ]);
        // Add the mock subscriber to the client.
        $clientMock->getHttpClient()->getEmitter()->attach($mock);

        return $clientMock;
    }

    /**
     * @return ResponseInterface
     */
    protected function getQueryResult()
    {
        return [
            'count' => 1,
            'total' => 1,
            'offset' => 0,
            'results' => [
                [
                    'key' => 'value'
                ]
            ]
        ];
    }

    /**
     * @return ResponseInterface
     */
    protected function getSingleOpResult()
    {
        return ['key' => 'value'];
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
}
