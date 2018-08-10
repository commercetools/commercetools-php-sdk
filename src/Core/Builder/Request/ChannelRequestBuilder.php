<?php

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Channels\ChannelByIdGetRequest;
use Commercetools\Core\Request\Channels\ChannelCreateRequest;
use Commercetools\Core\Model\Channel\ChannelDraft;
use Commercetools\Core\Request\Channels\ChannelDeleteRequest;
use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Request\Channels\ChannelQueryRequest;
use Commercetools\Core\Request\Channels\ChannelUpdateRequest;

class ChannelRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#get-channel-by-id
     * @param string $id
     * @return ChannelByIdGetRequest
     */
    public function getById($id)
    {
        $request = ChannelByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#create-a-channel
     * @param ChannelDraft $channel
     * @return ChannelCreateRequest
     */
    public function create(ChannelDraft $channel)
    {
        $request = ChannelCreateRequest::ofDraft($channel);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#delete-channel
     * @param Channel $channel
     * @return ChannelDeleteRequest
     */
    public function delete(Channel $channel)
    {
        $request = ChannelDeleteRequest::ofIdAndVersion($channel->getId(), $channel->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#query-channels
     * @param 
     * @return ChannelQueryRequest
     */
    public function query()
    {
        $request = ChannelQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#update-channel
     * @param Channel $channel
     * @return ChannelUpdateRequest
     */
    public function update(Channel $channel)
    {
        $request = ChannelUpdateRequest::ofIdAndVersion($channel->getId(), $channel->getVersion());
        return $request;
    }

    /**
     * @return ChannelRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
