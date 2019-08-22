<?php
/**
 *
 */

namespace Commercetools\Core\IntegrationTests\ApiClient;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\ApiClient\ApiClient;
use Commercetools\Core\Model\ApiClient\ApiClientCollection;
use Commercetools\Core\Model\ApiClient\ApiClientDraft;
use Commercetools\Core\Request\ApiClients\ApiClientByIdGetRequest;
use Commercetools\Core\Request\ApiClients\ApiClientCreateRequest;
use Commercetools\Core\Request\ApiClients\ApiClientDeleteRequest;
use Commercetools\Core\Request\ApiClients\ApiClientQueryRequest;

class ApiClientTest extends ApiTestCase
{
    const API_CLIENTS_SCOPE = 'manage_api_clients';

    public function testApiClient()
    {
        $client = $this->getClient(self::API_CLIENTS_SCOPE);
        $project = $client->getConfig()->getProject();

        $apiClientDraft = ApiClientDraft::of()
            ->setName('test-' . $this->getTestRun())->setScope('view_products:' . $project);
        $request = ApiClientCreateRequest::ofDraft($apiClientDraft);
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertNotNull($result);
        $this->assertNotNull($result->getId());
        $getByIdRequest = ApiClientByIdGetRequest::ofId($result->getId());
        $getResponse = $getByIdRequest->executeWithClient($client);
        $getResult = $request->mapResponse($getResponse);

        $this->assertInstanceOf(ApiClient::class, $getResult);
        $this->assertSame('test-' . $this->getTestRun(), $getResult->getName());
        $this->assertSame('view_products:' . $project, $getResult->getScope());
        $this->assertNotNull($getResult->getId());
        $this->assertNull($getResult->getSecret());

        $queryRequest = ApiClientQueryRequest::of();
        $queryResponse = $queryRequest->executeWithClient($client);
        $queryResult = $queryRequest->mapResponse($queryResponse);

        $this->assertInstanceOf(ApiClientCollection::class, $queryResult);
        $this->assertInstanceOf(ApiClient::class, $queryResult->current());

        $deleteRequest = ApiClientDeleteRequest::ofId($result->getId());

        $deleteResponse = $deleteRequest->executeWithClient($client);
        $deleteResult = $request->mapResponse($deleteResponse);

        $this->assertInstanceOf(ApiClient::class, $deleteResult);
        $this->assertSame('test-' . $this->getTestRun(), $deleteResult->getName());

        $getByIdRequest = ApiClientByIdGetRequest::ofId($result->getId());
        $getResponse = $getByIdRequest->executeWithClient($client);
        $getResult = $request->mapResponse($getResponse);

        $this->assertNull($getResult);
    }
}
