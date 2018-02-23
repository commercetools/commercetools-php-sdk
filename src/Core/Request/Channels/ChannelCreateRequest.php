<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Channels;

use Commercetools\Core\Model\Channel\ChannelDraft;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Channels
 * @link https://docs.commercetools.com/http-api-projects-channels.html#create-a-channel
 * @method Channel mapResponse(ApiResponseInterface $response)
 * @method Channel mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ChannelCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = Channel::class;

    /**
     * @param ChannelDraft $channel
     * @param Context $context
     */
    public function __construct(ChannelDraft $channel, Context $context = null)
    {
        parent::__construct(ChannelsEndpoint::endpoint(), $channel, $context);
    }

    /**
     * @param ChannelDraft $channel
     * @param Context $context
     * @return static
     */
    public static function ofDraft(ChannelDraft $channel, Context $context = null)
    {
        return new static($channel, $context);
    }
}
