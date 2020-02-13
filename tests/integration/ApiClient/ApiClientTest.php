<?php
/**
 *
 */

namespace Commercetools\Core\IntegrationTests\ApiClient;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\Project\ProjectFixture;
use Commercetools\Core\Model\ApiClient\ApiClient;
use Commercetools\Core\Model\ApiClient\ApiClientCollection;
use Commercetools\Core\Model\ApiClient\ApiClientDraft;
use Commercetools\Core\Model\Project\Project;

class ApiClientTest extends ApiTestCase
{
    const API_CLIENTS_SCOPE = 'manage_api_clients';

    public function testApiClient()
    {
        $client = $this->getApiClient(self::API_CLIENTS_SCOPE);
        $projectClient = $this->getApiClient();

        ProjectFixture::withProject(
            $projectClient,
            function (Project $project) use ($client) {
                $deleteDaysAfterCreation = 1;
                $name = ProjectFixture::uniqueProjectString();

                $apiClientDraft = ApiClientDraft::ofNameAndScope($name, 'view_products:' . $project->getKey())
                    ->setDeleteDaysAfterCreation($deleteDaysAfterCreation);

                $createRequest = RequestBuilder::of()->apiClients()->create($apiClientDraft);
                $response = $this->execute($client, $createRequest);
                $result = $createRequest->mapFromResponse($response);

                $this->assertNotNull($result);
                $this->assertNotNull($result->getId());

                $calcDate = new \DateTime('+' . $deleteDaysAfterCreation . 'day');
                $this->assertEquals($calcDate->format('Y-m-d'), $result->getDeleteAt()->format('Y-m-d'));

                $getByIdRequest = RequestBuilder::of()->apiClients()->getById($result->getId());
                $getResponse =  $this->execute($client, $getByIdRequest);
                $getResult = $getByIdRequest->mapFromResponse($getResponse);

                $this->assertInstanceOf(ApiClient::class, $getResult);
                $this->assertSame($name, $getResult->getName());
                $this->assertSame('view_products:' . $project->getKey(), $getResult->getScope());
                $this->assertNotNull($getResult->getId());
                $this->assertNull($getResult->getSecret());

                $queryRequest = RequestBuilder::of()->apiClients()->query();
                $queryResponse = $this->execute($client, $queryRequest);
                $queryResult = $queryRequest->mapFromResponse($queryResponse);

                $this->assertInstanceOf(ApiClientCollection::class, $queryResult);
                $this->assertInstanceOf(ApiClient::class, $queryResult->current());

                $deleteRequest = RequestBuilder::of()->apiClients()->delete($result);
                $deleteResponse = $this->execute($client, $deleteRequest);
                $deleteResult = $deleteRequest->mapFromResponse($deleteResponse);

                $this->assertInstanceOf(ApiClient::class, $deleteResult);
                $this->assertSame($name, $deleteResult->getName());

                $this->expectException(FixtureException::class);
                $this->expectExceptionCode(404);
                $getByIdRequest = RequestBuilder::of()->apiClients()->getById($result->getId());
                $this->execute($client, $getByIdRequest);
            }
        );
    }
}
