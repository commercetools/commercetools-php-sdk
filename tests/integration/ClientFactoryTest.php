<?php

namespace Commercetools\Core\IntegrationTests;

use Commercetools\Core\Cache\CacheAdapterFactory;
use Commercetools\Core\Client\ClientFactory;
use Commercetools\Core\Client\OAuth\OAuth2Handler;
use Commercetools\Core\Client\OAuth\PreAuthTokenProvider;
use Commercetools\Core\Client\OAuth\Token;
use Commercetools\Core\Client\UserAgentProvider;
use Commercetools\Core\Config;
use Commercetools\Core\Error\ApiException;
use Commercetools\Core\Error\ErrorContainer;
use Commercetools\Core\Error\ErrorResponseException;
use Commercetools\Core\Error\InvalidClientCredentialsException;
use Commercetools\Core\Error\InvalidOperationError;
use Commercetools\Core\Error\NotFoundException;
use Commercetools\Core\Model\Category\CategoryCollection;
use Commercetools\Core\Request\Categories\CategoryByIdGetRequest;
use Commercetools\Core\Request\Categories\CategoryQueryRequest;
use Commercetools\Core\Request\Categories\CategoryUpdateRequest;
use Commercetools\Core\Request\Categories\Command\CategoryChangeNameAction;
use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Request\Project\ProjectGetRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Response as PsrResponse;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\SimpleCache\CacheInterface;

class ClientFactoryTest extends ApiTestCase
{
    use ProphecyTrait;

    public function testOf()
    {
        $this->assertInstanceOf(ClientFactory::class, ClientFactory::of());
    }

    public function testCustomGuzzleClient()
    {
        $this->assertInstanceOf(Client::class, ClientFactory::of()->createCustomClient(Client::class, $this->getClientConfig('manage_project')));
    }

    public function testCustomClient()
    {
        $this->assertInstanceOf(ApiClient::class, ClientFactory::of()->createCustomClient(ApiClient::class, $this->getClientConfig('manage_project')));
    }

    public function testCreateClient()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $config = $this->getClientConfig('manage_project');
        $config->setOAuthClientOptions(['verify' => $this->getVerifySSL(), 'timeout' => '10']);
        $config->setClientOptions(['verify' => $this->getVerifySSL(), 'timeout' => '10']);

        $client = ClientFactory::of()->createClient($config, $logger);
        $this->assertInstanceOf(ApiClient::class, $client);

        $request = CategoryQueryRequest::of();
        $response = $client->send($request->httpRequest());

        $this->assertInstanceOf(PsrResponse::class, $response);

        $categories = $request->mapFromResponse($response);
        $this->assertInstanceOf(CategoryCollection::class, $categories);

        $record = current($handler->getRecords());
        $this->assertStringStartsWith($config->getProject(), $record['context']['X-Correlation-ID'][0]);
        $this->assertStringContainsString((new UserAgentProvider())->getUserAgent(), $record['message']);
        echo (new UserAgentProvider())->getUserAgent();
    }

    public function testExecute()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $config = $this->getClientConfig('manage_project');
        $config->setOAuthClientOptions(['verify' => $this->getVerifySSL(), 'timeout' => '10']);
        $config->setClientOptions(['verify' => $this->getVerifySSL(), 'timeout' => '10']);

        $client = ClientFactory::of()->createClient($config, $logger);
        $this->assertInstanceOf(ApiClient::class, $client);

        $request = CategoryQueryRequest::of();
        $response = $client->execute($request);

        $this->assertInstanceOf(PsrResponse::class, $response);

        $categories = $request->mapFromResponse($response);
        $this->assertInstanceOf(CategoryCollection::class, $categories);

        $record = current($handler->getRecords());
        $this->assertStringStartsWith($config->getProject(), $record['context']['X-Correlation-ID'][0]);
        $this->assertStringContainsString((new UserAgentProvider())->getUserAgent(), $record['message']);
    }

    public function testExecuteAsync()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $config = $this->getClientConfig('manage_project');
        $config->setOAuthClientOptions(['verify' => $this->getVerifySSL(), 'timeout' => '10']);
        $config->setClientOptions(['verify' => $this->getVerifySSL(), 'timeout' => '10']);

        $client = ClientFactory::of()->createClient($config, $logger);
        $this->assertInstanceOf(ApiClient::class, $client);

        $request = CategoryQueryRequest::of();
        $response = $client->executeAsync($request)->wait();

        $this->assertInstanceOf(PsrResponse::class, $response);

        $categories = $request->mapFromResponse($response);
        $this->assertInstanceOf(CategoryCollection::class, $categories);

        $record = current($handler->getRecords());
        $this->assertStringStartsWith($config->getProject(), $record['context']['X-Correlation-ID'][0]);
        $this->assertStringContainsString((new UserAgentProvider())->getUserAgent(), $record['message']);
    }

    public function testClientNoException()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $config = $this->getClientConfig('manage_project');
        $config->setOAuthClientOptions(['verify' => $this->getVerifySSL(), 'timeout' => '10']);
        $config->setClientOptions(['verify' => $this->getVerifySSL(), 'timeout' => '10']);

        $client = ClientFactory::of()->createClient($config, $logger);
        $this->assertInstanceOf(ApiClient::class, $client);

        $request = CategoryByIdGetRequest::ofId("abc");
        $response = $client->send($request->httpRequest());

        $this->assertInstanceOf(PsrResponse::class, $response);

        $category = $request->mapFromResponse($response);
        $this->assertNull($category);
    }

    public function testClientException()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $config = $this->getClientConfig('manage_project')->setThrowExceptions(true);
        $config->setOAuthClientOptions(['verify' => $this->getVerifySSL(), 'timeout' => '10']);
        $config->setClientOptions(['verify' => $this->getVerifySSL(), 'timeout' => '10']);

        $client = ClientFactory::of()->createClient($config, $logger);
        $this->assertInstanceOf(ApiClient::class, $client);

        $request = CategoryByIdGetRequest::ofId("abc");
        $this->expectException(NotFoundException::class);
        $client->send($request->httpRequest());
    }

    public function testClientExceptionErrors()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $config = $this->getClientConfig('manage_project')->setThrowExceptions(true);
        $config->setOAuthClientOptions(['verify' => $this->getVerifySSL(), 'timeout' => '10']);
        $config->setClientOptions(['verify' => $this->getVerifySSL(), 'timeout' => '10']);

        $client = ClientFactory::of()->createClient($config, $logger);
        $this->assertInstanceOf(ApiClient::class, $client);

        $category = $this->getCategory();
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion());
        $request->addAction(CategoryChangeNameAction::ofName($category->getName()));

        $errors = null;
        try {
            $response = $client->send($request->httpRequest());
        } catch (ApiException $exception) {
            $this->assertInstanceOf(ErrorResponseException::class, $exception);
            $errors = ErrorContainer::fromArray($exception->getErrors());
        }

        $this->assertInstanceOf(ErrorContainer::class, $errors);
        $this->assertInstanceOf(InvalidOperationError::class, $errors->getByCode(InvalidOperationError::CODE));
    }

    public function testReAuthenticate()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);


        $config = $this->getClientConfig('manage_project');
        $config->setOAuthClientOptions(['verify' => $this->getVerifySSL(), 'timeout' => '10']);
        $config->setClientOptions(['verify' => $this->getVerifySSL(), 'timeout' => '10']);


        $cache = $this->prophesize(CacheInterface::class);
        $cache->get(Argument::any(), null)->willReturn('abc')->shouldBeCalledOnce();
        $cache->set(Argument::any(), Argument::any(), Argument::any())->shouldBeCalledOnce();

        $client = ClientFactory::of()->createClient($config, $logger, $cache->reveal());
        $this->assertInstanceOf(ApiClient::class, $client);

        $request = CategoryQueryRequest::of();
        $response = $client->send($request->httpRequest());

        $this->assertInstanceOf(PsrResponse::class, $response);

        $categories = $request->mapFromResponse($response);
        $this->assertInstanceOf(CategoryCollection::class, $categories);

        $record = current($handler->getRecords());
        $this->assertStringStartsWith($config->getProject(), $record['context']['X-Correlation-ID'][0]);
        $this->assertStringContainsString((new UserAgentProvider())->getUserAgent(), $record['message']);
    }

    public function testPreAuthProvider()
    {
        $provider = $this->prophesize(PreAuthTokenProvider::class);
        $provider->getToken()->willReturn(new Token('12345'))->shouldBeCalledOnce();

        $client = ClientFactory::of()->createClient(new Config(), null, null, $provider->reveal());

        $this->assertInstanceOf(ApiClient::class, $client);

        $request = CategoryQueryRequest::of();
        $response = $client->execute($request);

        $this->assertInstanceOf(PsrResponse::class, $response);

        $this->assertSame(401, $response->getStatusCode());
    }

    public function testInvalidCredentialsOAuthException()
    {
        $client = ClientFactory::of()->createClient(new Config());

        $this->assertInstanceOf(ApiClient::class, $client);

        $this->expectException(InvalidClientCredentialsException::class);
        $this->expectExceptionCode(401);

        $request = ProjectGetRequest::of();
        $client->execute($request);
    }
}
