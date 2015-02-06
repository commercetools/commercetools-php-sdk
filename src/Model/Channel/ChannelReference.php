<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\Channel;

use Sphere\Core\Model\Type\Reference;

/**
 * Class CategoryReference
 * @package Sphere\Core\Model\Type
 * @method static ChannelReference of(string $id)
 */
class ChannelReference extends Reference
{
    const TYPE_CHANNEL = 'channel';

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct(static::TYPE_CHANNEL, $id);
    }
}
