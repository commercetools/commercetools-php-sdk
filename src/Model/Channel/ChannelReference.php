<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\Channel;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

/**
 * Class CategoryReference
 * @package Sphere\Core\Model\Type
 * @method static ChannelReference of(string $id)
 */
class ChannelReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_CHANNEL = 'channel';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(static::TYPE_CHANNEL, $id, $context);
    }
}
