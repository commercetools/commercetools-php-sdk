<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Channel;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Model\Channel\ChannelDraft;
use Commercetools\Core\Model\Common\GeoPoint;

class ChannelQueryRequestTest extends ApiTestCase
{
    public function testQuery()
    {
        $client = $this->getApiClient();

        ChannelFixture::withChannel(
            $client,
            function (Channel $channel) use ($client) {
                $request = RequestBuilder::of()->channels()->query()
                    ->where('key=:key', ['key' => $channel->getKey()]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(Channel::class, $result->current());
                $this->assertSame($channel->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetById()
    {
        $client = $this->getApiClient();

        ChannelFixture::withChannel(
            $client,
            function (Channel $channel) use ($client) {
                $request = RequestBuilder::of()->channels()->getById($channel->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Channel::class, $result);
                $this->assertSame($channel->getId(), $result->getId());
            }
        );
    }

    public function testQueryByLocation()
    {
        $client = $this->getApiClient();
        $friedrichstadtPalast = [13.38881, 52.52394];
        $brandenburgerTor = [13.37770, 52.51627];

        ChannelFixture::withDraftChannel(
            $client,
            function (ChannelDraft $draft) use ($friedrichstadtPalast) {
                return $draft->setGeoLocation(GeoPoint::of()->setCoordinates($friedrichstadtPalast));
            },
            function (Channel $channel) use ($client, $brandenburgerTor) {
                $request = RequestBuilder::of()->channels()->query()
                    ->where(
                        sprintf('geoLocation within circle(%s, %s, 1150)', $brandenburgerTor[0], $brandenburgerTor[1])
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(Channel::class, $result->current());
                $this->assertSame($channel->getId(), $result->current()->getId());
            }
        );
    }

    public function testQueryByLocationNotWithin()
    {
        $client = $this->getApiClient();
        $friedrichstadtPalast = [13.38881, 52.52394];
        $brandenburgerTor = [13.37770, 52.51627];

        ChannelFixture::withDraftChannel(
            $client,
            function (ChannelDraft $draft) use ($friedrichstadtPalast) {
                return $draft->setGeoLocation(GeoPoint::of()->setCoordinates($friedrichstadtPalast));
            },
            function (Channel $channel) use ($client, $brandenburgerTor) {
                $request = RequestBuilder::of()->channels()->query()
                    ->where(
                        sprintf('geoLocation within circle(%s, %s, 1000)', $brandenburgerTor[0], $brandenburgerTor[1])
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(0, $result);
            }
        );
    }
}
