<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Project;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Project\Project;
use Commercetools\Core\Request\Project\ProjectGetRequest;
use Commercetools\Core\Response\AbstractApiResponse;

class ClientTest extends ApiTestCase
{
    public function testCorrelationId()
    {
        $request = ProjectGetRequest::of();

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $result);
        $this->assertStringStartsWith(
            $this->getClient()->getConfig()->getProject(),
            current($response->getHeader(AbstractApiResponse::X_CORRELATION_ID))
        );
    }
}
