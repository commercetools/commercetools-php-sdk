<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
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
        $config->getCredentials()->setScope('');
        $manager = new Manager($config);
        $manager->getHttpClient(['verify' => $this->getVerifySSL()]);

        $token = $manager->refreshToken();
        $this->assertEmpty($config->getCredentials()->getScope());
        $this->assertNotEmpty($token->getScope());
        $this->assertNotEmpty($token->getToken());
        $this->assertContains('manage_project', $token->getScope());
    }

    public function testCorrelationId()
    {
        $config = $this->getClientConfig('manage_project');
        $correlationId = DefaultCorrelationIdProvider::of($config->getCredentials()->getProject())->getCorrelationId() . '/' . $this->getTestRun();
        $provider = $this->prophesize(CorrelationIdProvider::class);
        $provider->getCorrelationId()->willReturn($correlationId);

        $config->getOauthClientConfig()->setCorrelationIdProvider($provider->reveal());

        $manager = new Manager($config);
        $manager->getHttpClient(['verify' => $this->getVerifySSL()]);

        $grantType = $config->getCredentials()->getGrantType();
        $data = [Config::GRANT_TYPE => $grantType];

        $response = $manager->execute($data);

        $this->assertSame(
            $correlationId,
            current($response->getHeader(AbstractApiResponse::X_CORRELATION_ID))
        );
    }
}
