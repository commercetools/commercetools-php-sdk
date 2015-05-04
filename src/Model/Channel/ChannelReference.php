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
 * Class ChannelReference
 * @package Sphere\Core\Model\Channel
 * @link http://dev.sphere.io/http-api-types.html#reference
 * @method static ChannelReference of(string $id)
 * @method string getTypeId()
 * @method ChannelReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method ChannelReference setId(string $id = null)
 * @method Channel getObj()
 * @method ChannelReference setObj(Channel $obj = null)
 */
class ChannelReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_CHANNEL = 'channel';

    public function getFields()
    {
        return [
            'typeId' => [self::TYPE => 'string'],
            'id' => [self::TYPE => 'string'],
            'obj' => [static::TYPE => '\Sphere\Core\Model\Channel\Channel']
        ];
    }

    /**
     * @param string $id
     * @param Context|callable $context
     */
    public function __construct($id, $context = null)
    {
        parent::__construct(static::TYPE_CHANNEL, $id, $context);
    }
}
