<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Channel;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Model\Channel\ChannelDraft;
use Commercetools\Core\Model\Common\GeoLocation;
use Commercetools\Core\Model\Common\GeoPoint;
use Commercetools\Core\Request\Channels\ChannelByIdGetRequest;
use Commercetools\Core\Request\Channels\ChannelCreateRequest;
use Commercetools\Core\Request\Channels\ChannelDeleteRequest;
use Commercetools\Core\Request\Channels\ChannelQueryRequest;

class ChannelQueryRequestTest extends ApiTestCase
{
    /**
     * @return ChannelDraft
     */
    protected function getDraft()
    {
        $draft = ChannelDraft::ofKey(
            'test-' . $this->getTestRun() . '-key'
        );

        return $draft;
    }

    protected function createChannel(ChannelDraft $draft)
    {
        $request = ChannelCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $channel = $request->mapResponse($response);

        $this->cleanupRequests[] = ChannelDeleteRequest::ofIdAndVersion(
            $channel->getId(),
            $channel->getVersion()
        );

        return $channel;
    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $channel = $this->createChannel($draft);

        $request = ChannelQueryRequest::of()->where('key="' . $draft->getKey() . '"');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(Channel::class, $result->getAt(0));
        $this->assertSame($channel->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $channel = $this->createChannel($draft);

        $request = ChannelByIdGetRequest::ofId($channel->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Channel::class, $channel);
        $this->assertSame($channel->getId(), $result->getId());

    }

    public function testQueryByLocation()
    {
        $friedrichstadtPalast = [13.38881, 52.52394];
        $brandenburgerTor = [13.37770, 52.51627];

        $draft = $this->getDraft();
        $draft->setGeoLocation(GeoPoint::of()->setCoordinates($friedrichstadtPalast));
        $channel = $this->createChannel($draft);

        $request = ChannelQueryRequest::of()->where(
            sprintf('geoLocation within circle(%s, %s, 1150)', $brandenburgerTor[0], $brandenburgerTor[1] )
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->assertCount(1, $result);
        $this->assertInstanceOf(Channel::class, $result->current());
        $this->assertSame($channel->getId(), $result->current()->getId());
    }

    public function testQueryByLocationNotWithin()
    {
        $friedrichstadtPalast = [13.38881, 52.52394];
        $brandenburgerTor = [13.37770, 52.51627];

        $draft = $this->getDraft();
        $draft->setGeoLocation(GeoPoint::of()->setCoordinates($friedrichstadtPalast));
        $channel = $this->createChannel($draft);

        $request = ChannelQueryRequest::of()->where(
            sprintf('geoLocation within circle(%s, %s, 1000)', $brandenburgerTor[0], $brandenburgerTor[1] )
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(0, $result);
    }
}
