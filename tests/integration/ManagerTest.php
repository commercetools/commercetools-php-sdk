<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core;


use Commercetools\Core\Client\OAuth\Manager;

class ManagerTest extends ApiTestCase
{
    public function testEmptyScope()
    {
        $config = $this->getClientConfig('manage_project');
        $config->setScope('');
        $manager = new Manager($config);

        $token = $manager->refreshToken();
        $this->assertEmpty($config->getScope());
        $this->assertNotEmpty($token->getScope());
        $this->assertNotEmpty($token->getToken());
        $this->assertContains('manage_project', $token->getScope());
    }
}
