<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\CartDiscount;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class CartDiscountTarget
 * @package Sphere\Core\Model\CartDiscount
 * @method string getType()
 * @method CartDiscountTarget setType(string $type)
 * @method string getPredicate()
 * @method CartDiscountTarget setPredicate(string $predicate)
 */
class CartDiscountTarget extends JsonObject
{
    const TYPE_LINE_ITEMS = 'lineItems';

    public function getFields()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'predicate' => [static::TYPE => 'string'],
        ];
    }
}
