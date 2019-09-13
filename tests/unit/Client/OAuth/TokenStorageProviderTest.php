<?php

namespace Commercetools\Core\Client\OAuth;

use PHPUnit\Framework\TestCase;

class TokenStorageProviderTest extends TestCase
{
    public function testGetToken()
    {
        $anonToken = new Token('access-token');
        $anonToken->setRefreshToken('refresh-token');

        $anonTokenProvider = $this->prophesize(AnonymousFlowTokenProvider::class);
        $anonTokenProvider->getToken()->willReturn($anonToken)->shouldBeCalled();

        $storage = $this->prophesize(TokenStorage::class);
        $storage->getAccessToken()->shouldBeCalled();
        $storage->getRefreshToken()->shouldBeCalled();
        $storage->setAccessToken('access-token')->shouldBeCalled();
        $storage->setRefreshToken('refresh-token')->shouldBeCalled();

        $provider = new TokenStorageProvider(
            $storage->reveal(),
            $anonTokenProvider->reveal()
        );

        $token = $provider->getToken();

        $this->assertInstanceOf(Token::class, $token);
        $this->assertSame("access-token", $token->getToken());
        $this->assertSame("refresh-token", $token->getRefreshToken());
    }

    public function testRefreshToken()
    {
        $anonToken = new Token('access-token');
        $anonToken->setRefreshToken('refresh-token');

        $anonTokenProvider = $this->prophesize(AnonymousFlowTokenProvider::class);
        $anonTokenProvider->refreshToken()->willReturn($anonToken)->shouldBeCalled();

        $storage = $this->prophesize(TokenStorage::class);
        $storage->setAccessToken('access-token')->shouldBeCalled();
        $storage->setRefreshToken('refresh-token')->shouldBeCalled();

        $provider = new TokenStorageProvider(
            $storage->reveal(),
            $anonTokenProvider->reveal()
        );

        $token = $provider->refreshToken();

        $this->assertInstanceOf(Token::class, $token);
        $this->assertSame("access-token", $token->getToken());
        $this->assertSame("refresh-token", $token->getRefreshToken());
    }

    public function testGetTokenWithAccessToken()
    {
        $anonTokenProvider = $this->prophesize(AnonymousFlowTokenProvider::class);

        $storage = $this->prophesize(TokenStorage::class);
        $storage->getAccessToken()->willReturn('access-token')->shouldBeCalled();

        $provider = new TokenStorageProvider(
            $storage->reveal(),
            $anonTokenProvider->reveal()
        );

        $token = $provider->getToken();

        $this->assertInstanceOf(Token::class, $token);
        $this->assertSame("access-token", $token->getToken());
        $this->assertNull($token->getRefreshToken());
    }

    public function testGetTokenWithRefreshToken()
    {
        $anonToken = new Token('access-token');
        $anonToken->setRefreshToken('refresh-token');

        $anonTokenProvider = $this->prophesize(AnonymousFlowTokenProvider::class);
        $anonTokenProvider->refreshToken()->willReturn($anonToken)->shouldBeCalled();

        $storage = $this->prophesize(TokenStorage::class);
        $storage->getAccessToken()->shouldBeCalled();
        $storage->getRefreshToken()->willReturn('refresh-token')->shouldBeCalled();
        $storage->setAccessToken('access-token')->shouldBeCalled();
        $storage->setRefreshToken('refresh-token')->shouldBeCalled();

        $provider = new TokenStorageProvider(
            $storage->reveal(),
            $anonTokenProvider->reveal()
        );

        $token = $provider->getToken();

        $this->assertInstanceOf(Token::class, $token);
        $this->assertSame("access-token", $token->getToken());
        $this->assertSame("refresh-token", $token->getRefreshToken());
    }
}
