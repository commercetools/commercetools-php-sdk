<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 10.02.15, 15:58
 */

namespace Commercetools\Core\Client\OAuth;

class TokenTest extends \PHPUnit\Framework\TestCase
{
    public function testGetTtl()
    {
        $token = new Token('token', 1000);
        $this->assertSame(1000, $token->getTtl());
    }

    public function testGetToken()
    {
        $token = new Token('token', 1000);
        $this->assertSame('token', $token->getToken());
    }

    public function testGetValidTo()
    {
        $token = new Token('token', 1000);
        $token->setValidTo(new \DateTime());
        $this->assertInstanceOf('\DateTime', $token->getValidTo());
    }
}
