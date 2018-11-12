<?php
/**
 */

namespace Commercetools\Core\Model\OrderEdit;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\OrderEdit
 *
 * @method string getTypeId()
 * @method OrderEditReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method OrderEditReference setId(string $id = null)
 * @method string getKey()
 * @method OrderEditReference setKey(string $key = null)
 * @method OrderEdit getObj()
 * @method OrderEditReference setObj(OrderEdit $obj = null)
 */
class OrderEditReference extends Reference
{
    const TYPE_ORDER_EDIT = 'order-edit';
    const TYPE_CLASS = OrderEdit::class;

    /**
     * @param $id
     * @param Context|callable $context
     * @return OrderEditReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_ORDER_EDIT, $id, $context);
    }
}
