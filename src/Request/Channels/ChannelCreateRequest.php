<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Channels;


use Sphere\Core\Model\Channel\ChannelDraft;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractCreateRequest;

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
}
