<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Order
 * @link http://dev.commercetools.com/http-api-types.html#reference
 * @method string getTypeId()
 * @method OrderReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method OrderReference setId(string $id = null)
 * @method Order getObj()
 * @method OrderReference setObj(Order $obj = null)
 * @method string getKey()
 * @method OrderReference setKey(string $key = null)
 */
class OrderReference extends Reference
{
    const TYPE_ORDER = 'order';

    public function fieldDefinitions()
    {
        $fields = parent::fieldDefinitions();
        $fields[static::OBJ] = [static::TYPE => '\Commercetools\Core\Model\Order\Order'];

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
