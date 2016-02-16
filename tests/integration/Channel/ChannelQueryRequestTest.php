<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Channel;


use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Model\Channel\ChannelDraft;
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

    public function testQueryByName()
    {
        $draft = $this->getDraft();
        $channel = $this->createChannel($draft);

        $result = $this->getClient()->execute(
            ChannelQueryRequest::of()->where('key="' . $draft->getKey() . '"')
        )->toObject();

        $this->assertCount(1, $result);
        $this->assertInstanceOf('\Commercetools\Core\Model\Channel\Channel', $result->getAt(0));
        $this->assertSame($channel->getId(), $result->getAt(0)->getId());
    }

    public function testQueryById()
    {
        $draft = $this->getDraft();
        $channel = $this->createChannel($draft);

        $result = $this->getClient()->execute(ChannelByIdGetRequest::ofId($channel->getId()))->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Channel\Channel', $channel);
        $this->assertSame($channel->getId(), $result->getId());

    }
}
