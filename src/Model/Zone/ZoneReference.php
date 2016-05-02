<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Zone;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Zone
 * @link https://dev.commercetools.com/http-api-types.html#reference-types
 * @link https://dev.commercetools.com/http-api-projects-zones.html#zone
 * @method string getTypeId()
 * @method ZoneReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method ZoneReference setId(string $id = null)
 * @method Zone getObj()
 * @method ZoneReference setObj(Zone $obj = null)
 * @method string getKey()
 * @method ZoneReference setKey(string $key = null)
 */
class ZoneReference extends Reference
{
    const TYPE_ZONE = 'zone';
    const TYPE_CLASS = '\Commercetools\Core\Model\Zone\Zone';

    /**
     * @param $id
     * @param Context|callable $context
     * @return ZoneReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_ZONE, $id, $context);
    }
}
