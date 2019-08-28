<?php

namespace Commercetools\Core\Client\OAuth;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class AnonymousFlowTokenProviderTest extends TestCase
{
    const ANON_RESPONSE = '{
            "access_token": "access-token",
            "expires_in": 172800,
            "scope": "view_products:{projectKey} manage_my_orders:{projectKey} manage_my_profile:{projectKey} anonymous_id:{uniqueId}",
            "refresh_token": "refresh-token",
            "token_type": "Bearer"
        }';

    public function testGetToken()
    {
        $client = $this->prophesize(Client::class);
        $client->post(
            'anon-url',
            ["form_params" => ["grant_type" => "client_credentials"], "auth" => ["client-id", "client-secret"]]
        )
            ->willReturn(new Response(200, [], self::ANON_RESPONSE))
            ->shouldBeCalledOnce();

        $refreshTokenProvider = $this->prophesize(RefreshFlowTokenProvider::class);
        $credentials = $this->prophesize(ClientCredentials::class);
        $credentials->getClientId()->willReturn('client-id')->shouldBeCalledOnce();
        $credentials->getClientSecret()->willReturn('client-secret')->shouldBeCalledOnce();

        $provider = new AnonymousFlowTokenProvider(
            $client->reveal(),
            'anon-url',
            $credentials->reveal(),
            $refreshTokenProvider->reveal()
        );

        $token = $provider->getToken();

        $this->assertInstanceOf(Token::class, $token);
        $this->assertSame("access-token", $token->getToken());
        $this->assertSame("refresh-token", $token->getRefreshToken());
    }

    public function testRefreshToken()
    {
        $client = $this->prophesize(Client::class);
        $credentials = $this->prophesize(ClientCredentials::class);
        $refreshTokenProvider = $this->prophesize(RefreshFlowTokenProvider::class);
        $refreshTokenProvider->refreshToken()->willReturn(new Token('access-token'))->shouldBeCalledOnce();

        $provider = new AnonymousFlowTokenProvider(
            $client->reveal(),
            'anon-url',
            $credentials->reveal(),
            $refreshTokenProvider->reveal()
        );

        $token = $provider->refreshToken();

        $this->assertInstanceOf(Token::class, $token);
        $this->assertSame("access-token", $token->getToken());
    }
}
