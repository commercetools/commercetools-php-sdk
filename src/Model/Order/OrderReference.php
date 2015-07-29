<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;

/**
 * @package Sphere\Core\Model\Order
 * @apidoc http://dev.sphere.io/http-api-types.html#reference
 * @method string getTypeId()
 * @method OrderReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method OrderReference setId(string $id = null)
 * @method Order getObj()
 * @method OrderReference setObj(Order $obj = null)
 */
class OrderReference extends Reference
{
    const TYPE_ORDER = 'order';

    public function getFields()
    {
        $fields = parent::getFields();
        $fields[static::OBJ] = [static::TYPE => '\Sphere\Core\Model\Order\Order'];

        return $fields;
    }

    /**
     * @param $id
     * @param Context|callable $context
     * @return OrderReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_ORDER, $id, $context);
    }
}
