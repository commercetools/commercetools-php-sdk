<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests;

use Commercetools\Core\Fixtures\FooHandler;
use Commercetools\Core\Client;
use Commercetools\Core\Helper\CorrelationIdProvider;
use Commercetools\Core\Helper\DefaultCorrelationIdProvider;
use Commercetools\Core\Model\Project\Project;
use Commercetools\Core\Request\Project\ProjectGetRequest;
use Commercetools\Core\Response\AbstractApiResponse;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Http\Message\ResponseInterface;

class ClientTest extends ApiTestCase
{
    use ProphecyTrait;

    public function testCorrelationId()
    {
        $config = $this->getClientConfig('manage_project');
        $correlationId = DefaultCorrelationIdProvider::of($config->getProject())->getCorrelationId() . '/' . $this->getTestRun();
        $provider = $this->prophesize(CorrelationIdProvider::class);
        $provider->getCorrelationId()->willReturn($correlationId);

        $request = ProjectGetRequest::of();

        $config->setCorrelationIdProvider($provider->reveal());

        $client = Client::ofConfigCacheAndLogger($config, $this->getCache(), $this->getLogger());
        $client->getOauthManager()->getHttpClient(['verify' => $this->getVerifySSL()]);
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);

        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $result);
        $this->assertSame(
            $correlationId,
            current($response->getHeader(AbstractApiResponse::X_CORRELATION_ID))
        );
    }


    public function testCustomHandlerStack()
    {
        if (defined('\GuzzleHttp\Client::MAJOR_VERSION')) {
            $clientVersion = (string) constant(HttpClient::class . '::MAJOR_VERSION');
        } else {
            $clientVersion = (string) constant(HttpClient::class . '::VERSION');
        }
        if (version_compare($clientVersion, '6.0.0', '<')) {
            $this->markTestSkipped("Only valid for Guzzle version < 6");
        }

        $logHandler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($logHandler);

        $stack = HandlerStack::create(new FooHandler("bar"));
        $clientConfig = $this->getClientConfig('manage_project')->setClientOptions(['handler' => $stack]);
        $clientConfig->setOAuthClientOptions(['verify' => $this->getVerifySSL(), 'timeout' => '20']);
        $client = Client::ofConfigAndLogger(
            $clientConfig,
            $logger
        );
        $promise = $client->executeAsync(
            ProjectGetRequest::of(),
            null
        );
        $response = $promise->then(
            function (ResponseInterface $response) {
            }
        )->wait();

        $this->assertSame("bar", (string)$response->getBody());
        $this->assertStringStartsWith($clientConfig->getProject(), $response->getHeaderLine(AbstractApiResponse::X_CORRELATION_ID));

        $record = current($logHandler->getRecords());

        $this->assertTrue($logHandler->hasInfo($record));
        $this->assertStringContainsString('/'.$clientConfig->getProject().'/ HTTP/1.1" 200', (string)$record['message']);
        $this->assertStringStartsWith($clientConfig->getProject(), current($record['context'][AbstractApiResponse::X_CORRELATION_ID]));
        $this->assertSame(Logger::INFO, $record['level']);
    }
}
