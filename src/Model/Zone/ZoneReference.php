<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Zone;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;

/**
 * @package Sphere\Core\Model\Zone
 * @method string getTypeId()
 * @method ZoneReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method ZoneReference setId(string $id = null)
 * @method Zone getObj()
 * @method ZoneReference setObj(Zone $obj = null)
 */
class ZoneReference extends Reference
{
    const TYPE_ZONE = 'zone';

    public function getFields()
    {
        $fields = parent::getFields();
        $fields[static::OBJ] = [static::TYPE => '\Sphere\Core\Model\Zone\Zone'];

        return $fields;
    }

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
