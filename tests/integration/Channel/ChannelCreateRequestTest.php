<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Channel;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Model\Channel\ChannelDraft;

class ChannelCreateRequestTest extends ApiTestCase
{
    public function testCreate()
    {
        $client = $this->getApiClient();

        ChannelFixture::withDraftChannel(
            $client,
            function (ChannelDraft $draft) {
                return $draft->setKey('myChannel');
            },
            function (Channel $channel) use ($client) {
                $request = RequestBuilder::of()->channels()->query()
                    ->where('key="' . $channel->getKey() . '"');
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($channel->getKey(), $result->current()->getKey());
            }
        );
    }
}
