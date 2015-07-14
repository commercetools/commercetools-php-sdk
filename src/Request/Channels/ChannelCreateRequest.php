<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Channels;

use Sphere\Core\Model\Channel\ChannelDraft;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractCreateRequest;
use Sphere\Core\Model\Channel\Channel;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Class ChannelCreateRequest
 * @package Sphere\Core\Request\Channels
 * 
 * @method Channel mapResponse(ApiResponseInterface $response)
 */
class ChannelCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\Channel\Channel';

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
