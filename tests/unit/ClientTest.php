<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 29.01.15, 15:16
 */

namespace Sphere\Core;


use Sphere\Core\Http\JsonEndpoint;
use Sphere\Core\OAuth\Token;
use Zend\Stdlib\ResponseInterface;

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
    protected function getMockClient($config, $returnValue)
    {
        $guzzleMock = $this->getMock('\GuzzleHttp\Client', ['send']);
        $guzzleMock->expects($this->any())
            ->method('send')
            ->will($this->returnValue($returnValue));

        $oauthMock = $this->getMock('\Sphere\Core\OAuth\Manager', ['getToken'], [$config]);
        $oauthMock->expects($this->any())
            ->method('getToken')
            ->will($this->returnValue(new Token('token')));

        $clientMock = $this->getMock('\Sphere\Core\Client', ['getHttpClient', 'getOauthManager'], [$config]);
        $clientMock->expects($this->any())
            ->method('getOauthManager')
            ->will($this->returnValue($oauthMock));
        $clientMock->expects($this->any())
            ->method('getHttpClient')
            ->will($this->returnValue($guzzleMock));

        return $clientMock;
    }

    /**
     * @return ResponseInterface
     */
    protected function getQueryResult()
    {
        $result = [
            'count' => 1,
            'total' => 1,
            'offset' => 0,
            'results' => [
                [
                    'key' => 'value'
                ]
            ]
        ];
        $response = $this->getMock('\GuzzleHttp\Message\Response', ['json'], [200]);
        $response->expects($this->any())
            ->method('json')
            ->will($this->returnValue($result));

        return $response;
    }

    /**
     * @return ResponseInterface
     */
    protected function getSingleOpResult()
    {
        $response = $this->getMock('\GuzzleHttp\Message\Response', ['json'], [200]);
        $response->expects($this->any())
            ->method('json')
            ->will($this->returnValue(['key' => 'value']));

        return $response;
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
        $this->assertInstanceOf('\Sphere\Core\OAuth\Manager', $client->getOauthManager());
    }
}
