<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\Channel;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;

/**
 * @package Sphere\Core\Model\Channel
 * @link http://dev.sphere.io/http-api-types.html#reference
 * @method string getTypeId()
 * @method ChannelReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method ChannelReference setId(string $id = null)
 * @method Channel getObj()
 * @method ChannelReference setObj(Channel $obj = null)
 */
class ChannelReference extends Reference
{
    const TYPE_CHANNEL = 'channel';

    public function getFields()
    {
        $fields = parent::getFields();
        $fields[static::OBJ] = [static::TYPE => '\Sphere\Core\Model\Channel\Channel'];

        return $fields;
    }

    /**
     * @param $id
     * @param Context|callable $context
     * @return ChannelReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_CHANNEL, $id, $context);
    }
}
