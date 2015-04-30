<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Zone;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

/**
 * Class ZoneReference
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
    use ReferenceFromArrayTrait;

    const TYPE_ZONE = 'zone';

    public function getFields()
    {
        return [
            'typeId' => [self::TYPE => 'string'],
            'id' => [self::TYPE => 'string'],
            'obj' => [static::TYPE => '\Sphere\Core\Model\Zone\Zone']
        ];
    }

    /**
     * @param string $id
     * @param Context|callable $context
     */
    public function __construct($id, $context = null)
    {
        parent::__construct(static::TYPE_ZONE, $id, $context);
    }
}
