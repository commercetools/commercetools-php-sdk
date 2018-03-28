<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Model\Channel\ChannelDraft;
use Commercetools\Core\Request\Channels\ChannelByIdGetRequest;
use Commercetools\Core\Request\Channels\ChannelCreateRequest;
use Commercetools\Core\Request\Channels\ChannelDeleteRequest;
use Commercetools\Core\Request\Channels\ChannelQueryRequest;
use Commercetools\Core\Request\Channels\ChannelUpdateRequest;

class ChannelRequestBuilder
{
    /**
     * @return ChannelQueryRequest
     */
    public function query()
    {
        return ChannelQueryRequest::of();
    }

    /**
     * @param Channel $channel
     * @return ChannelUpdateRequest
     */
    public function update(Channel $channel)
    {
        return ChannelUpdateRequest::ofIdAndVersion($channel->getId(), $channel->getVersion());
    }

    /**
     * @param ChannelDraft $channelDraft
     * @return ChannelCreateRequest
     */
    public function create(ChannelDraft $channelDraft)
    {
        return ChannelCreateRequest::ofDraft($channelDraft);
    }

    /**
     * @param Channel $channel
     * @return ChannelDeleteRequest
     */
    public function delete(Channel $channel)
    {
        return ChannelDeleteRequest::ofIdAndVersion($channel->getId(), $channel->getVersion());
    }

    /**
     * @param string $id
     * @return ChannelByIdGetRequest
     */
    public function getById($id)
    {
        return ChannelByIdGetRequest::ofId($id);
    }
}
