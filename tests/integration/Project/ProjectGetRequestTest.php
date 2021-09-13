<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Project;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Project\Project;
use Commercetools\Core\Request\Project\Command\ProjectChangeLanguagesAction;

class ProjectGetRequestTest extends ApiTestCase
{
    public function testGetProject()
    {
        $client = $this->getApiClient();

        ProjectFixture::withProject(
            $client,
            function (Project $project) use ($client) {
                $request = RequestBuilder::of()->project()->get();
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertSame($project->getKey(), $result->getKey());
            }
        );
    }
}
