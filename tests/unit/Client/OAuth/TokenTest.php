<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 10.02.15, 15:58
 */

namespace Commercetools\Core\Client\OAuth;

use Prophecy\PhpUnit\ProphecyTrait;

class TokenTest extends \PHPUnit\Framework\TestCase
{
    use ProphecyTrait;

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
