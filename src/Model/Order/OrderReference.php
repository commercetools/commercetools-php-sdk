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
 * @link https://dev.commercetools.com/http-api-types.html#reference-types
 * @link https://dev.commercetools.com/http-api-projects-orders.html#order
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
    const TYPE_CLASS = Order::class;

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
