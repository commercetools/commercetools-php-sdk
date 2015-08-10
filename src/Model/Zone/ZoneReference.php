<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Zone;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Zone
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

    public function getPropertyDefinitions()
    {
        $fields = parent::getPropertyDefinitions();
        $fields[static::OBJ] = [static::TYPE => '\Commercetools\Core\Model\Zone\Zone'];

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
