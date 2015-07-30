<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Channels;

use Commercetools\Core\Model\Channel\ChannelDraft;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Channels
 * 
 * @method Channel mapResponse(ApiResponseInterface $response)
 */
class ChannelCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Channel\Channel';

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
