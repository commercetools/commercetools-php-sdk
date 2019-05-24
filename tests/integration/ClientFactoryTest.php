<?php

namespace Commercetools\Core\IntegrationTests;

use Commercetools\Core\Client\ClientFactory;
use Commercetools\Core\Client\UserAgentProvider;
use Commercetools\Core\Error\ApiException;
use Commercetools\Core\Error\ErrorContainer;
use Commercetools\Core\Error\ErrorResponseException;
use Commercetools\Core\Error\InvalidOperationError;
use Commercetools\Core\Model\Category\CategoryCollection;
use Commercetools\Core\Request\Categories\CategoryByIdGetRequest;
use Commercetools\Core\Request\Categories\CategoryQueryRequest;
use Commercetools\Core\Request\Categories\CategoryUpdateRequest;
use Commercetools\Core\Request\Categories\Command\CategoryChangeNameAction;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response as PsrResponse;
use Monolog\Handler\TestHandler;
use Monolog\Logger;

class ClientFactoryTest extends ApiTestCase
{
    public function testOf()
    {
        $this->assertInstanceOf(ClientFactory::class, ClientFactory::of());
    }

    public function testCreateClient()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $config = $this->getClientConfig('manage_project');
        $client = ClientFactory::of()->createClient($config, $logger);
        $this->assertInstanceOf(HttpClient::class, $client);

        $request = CategoryQueryRequest::of();
        $response = $client->send($request->httpRequest());

        $this->assertInstanceOf(PsrResponse::class, $response);

        $categories = $request->mapFromResponse($response);
        $this->assertInstanceOf(CategoryCollection::class, $categories);

        $record = current($handler->getRecords());
        $this->assertStringStartsWith($config->getProject(), $record['context']['X-Correlation-ID'][0]);
        $this->assertContains((new UserAgentProvider())->getUserAgent(), $record['message']);
    }

    public function testClientNoException()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $config = $this->getClientConfig('manage_project');
        $client = ClientFactory::of()->createClient($config, $logger);
        $this->assertInstanceOf(HttpClient::class, $client);

        $request = CategoryByIdGetRequest::ofId("abc");
        $response = $client->send($request->httpRequest());

        $this->assertInstanceOf(PsrResponse::class, $response);

        $category = $request->mapFromResponse($response);
        $this->assertNull($category);
    }

    /**
     * @expectedException \Commercetools\Core\Error\NotFoundException
     */
    public function testClientException()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $config = $this->getClientConfig('manage_project')->setThrowExceptions(true);
        $client = ClientFactory::of()->createClient($config, $logger);
        $this->assertInstanceOf(HttpClient::class, $client);

        $request = CategoryByIdGetRequest::ofId("abc");
        $client->send($request->httpRequest());
    }

    public function testClientExceptionErrors()
    {
        $handler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($handler);

        $config = $this->getClientConfig('manage_project')->setThrowExceptions(true);
        $client = ClientFactory::of()->createClient($config, $logger);
        $this->assertInstanceOf(HttpClient::class, $client);

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
}
