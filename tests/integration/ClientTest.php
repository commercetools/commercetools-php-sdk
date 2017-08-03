<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Project;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Client;
use Commercetools\Core\Helper\CorrelationIdProvider;
use Commercetools\Core\Helper\DefaultCorrelationIdProvider;
use Commercetools\Core\Model\Project\Project;
use Commercetools\Core\Request\Project\ProjectGetRequest;
use Commercetools\Core\Response\AbstractApiResponse;
use Ramsey\Uuid\Uuid;

class ClientTest extends ApiTestCase
{
    public function testCorrelationId()
    {

        $correlationId = DefaultCorrelationIdProvider::of('test-' .$this->getTestRun())->getCorrelationId();
        $provider = $this->prophesize(CorrelationIdProvider::class);
        $provider->getCorrelationId()->willReturn($correlationId);

        $request = ProjectGetRequest::of();

        $config = $this->getClientConfig('manage_project');
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
}
