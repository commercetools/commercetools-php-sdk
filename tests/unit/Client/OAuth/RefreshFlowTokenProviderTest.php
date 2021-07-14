<?php

namespace Commercetools\Core\Client\OAuth;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class RefreshFlowTokenProviderTest extends TestCase
{
    use ProphecyTrait;

    const REFRESH_RESPONSE = '{
            "access_token": "access-token",
            "expires_in": 172800,
            "scope": "view_products:{projectKey} manage_my_orders:{projectKey} manage_my_profile:{projectKey} anonymous_id:{uniqueId}",
            "token_type": "Bearer"
        }';

    public function testGetToken()
    {
        $client = $this->prophesize(Client::class);
        $client->post(
            'refresh-url',
            ["form_params" => ["grant_type" => "refresh_token", "refresh_token" => "refresh-token"], "auth" => ["client-id", "client-secret"]]
        )
            ->willReturn(new Response(200, [], self::REFRESH_RESPONSE))
            ->shouldBeCalled();

        $tokenStorage = $this->prophesize(TokenStorage::class);
        $tokenStorage->getRefreshToken()->willReturn('refresh-token')->shouldBeCalled();

        $credentials = $this->prophesize(ClientCredentials::class);
        $credentials->getClientId()->willReturn('client-id')->shouldBeCalled();
        $credentials->getClientSecret()->willReturn('client-secret')->shouldBeCalled();

        $provider = new RefreshFlowTokenProvider(
            $client->reveal(),
            'refresh-url',
            $credentials->reveal(),
            $tokenStorage->reveal()
        );

        $token = $provider->getToken();

        $this->assertInstanceOf(Token::class, $token);
        $this->assertSame("access-token", $token->getToken());
        $this->assertSame("refresh-token", $token->getRefreshToken());
    }

    public function testRefreshToken()
    {
        $client = $this->prophesize(Client::class);
        $client->post(
            'refresh-url',
            ["form_params" => ["grant_type" => "refresh_token", "refresh_token" => "refresh-token"], "auth" => ["client-id", "client-secret"]]
        )
            ->willReturn(new Response(200, [], self::REFRESH_RESPONSE))
            ->shouldBeCalled();

        $tokenStorage = $this->prophesize(TokenStorage::class);
        $tokenStorage->getRefreshToken()->willReturn('refresh-token')->shouldBeCalled();

        $credentials = $this->prophesize(ClientCredentials::class);
        $credentials->getClientId()->willReturn('client-id')->shouldBeCalled();
        $credentials->getClientSecret()->willReturn('client-secret')->shouldBeCalled();

        $provider = new RefreshFlowTokenProvider(
            $client->reveal(),
            'refresh-url',
            $credentials->reveal(),
            $tokenStorage->reveal()
        );

        $token = $provider->refreshToken();

        $this->assertInstanceOf(Token::class, $token);
        $this->assertSame("access-token", $token->getToken());
        $this->assertSame("refresh-token", $token->getRefreshToken());
    }
}
