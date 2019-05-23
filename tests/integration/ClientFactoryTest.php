<?php

namespace Commercetools\Core;

use Commercetools\Core\Client\ClientFactory;
use Commercetools\Core\Model\Project\Project;
use Commercetools\Core\Request\Project\ProjectGetRequest;
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

        $request = ProjectGetRequest::of();
        $response = $client->send($request->httpRequest());

        $this->assertInstanceOf(PsrResponse::class, $response);

        $project = $request->mapFromResponse($response);
        $this->assertInstanceOf(Project::class, $project);
    }
}
