<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Project;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Project\Project;
use Commercetools\Core\Request\Project\ProjectGetRequest;

class ProjectGetRequestTest extends ApiTestCase
{
    public function testGetProject()
    {
        $request = ProjectGetRequest::of();

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $result);
        $this->assertSame($this->getClient()->getConfig()->getProject(), $result->getKey());
    }
}
