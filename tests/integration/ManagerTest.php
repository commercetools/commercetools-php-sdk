<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core;


use Commercetools\Core\Client\OAuth\Manager;
use Commercetools\Core\Helper\CorrelationIdProvider;
use Commercetools\Core\Helper\DefaultCorrelationIdProvider;
use Commercetools\Core\Response\AbstractApiResponse;

class ManagerTest extends ApiTestCase
{
    public function testEmptyScope()
    {
        $config = $this->getClientConfig('manage_project');
        $config->setScope('');
        $manager = new Manager($config);
        $manager->getHttpClient(['verify' => $this->getVerifySSL()]);

        $token = $manager->refreshToken();
        $this->assertEmpty($config->getScope());
        $this->assertNotEmpty($token->getScope());
        $this->assertNotEmpty($token->getToken());
        $this->assertContains('manage_project', $token->getScope());
    }

    public function testCorrelationId()
    {
        $correlationId = DefaultCorrelationIdProvider::of('test-' .$this->getTestRun())->getCorrelationId();
        $provider = $this->prophesize(CorrelationIdProvider::class);
        $provider->getCorrelationId()->willReturn($correlationId);

        $config = $this->getClientConfig('manage_project');
        $config->setCorrelationIdProvider($provider->reveal());

        $manager = new Manager($config);
        $manager->getHttpClient(['verify' => $this->getVerifySSL()]);

        $grantType = $config->getGrantType();
        $data = [Config::GRANT_TYPE => $grantType];

        $response = $manager->execute($data);

        $this->assertSame(
            $correlationId,
            current($response->getHeader(AbstractApiResponse::X_CORRELATION_ID))
        );
    }
}
