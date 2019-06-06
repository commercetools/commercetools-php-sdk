<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\Channel;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Channel\ChannelDraft;
use Commercetools\Core\Request\Channels\ChannelCreateRequest;
use Commercetools\Core\Request\Channels\ChannelDeleteRequest;

class ChannelCreateRequestTest extends ApiTestCase
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


    public function testCreate()
    {
        $draft = $this->getDraft();
        $channel = $this->createChannel($draft);
        $this->assertSame($draft->getKey(), $channel->getKey());
    }
}
