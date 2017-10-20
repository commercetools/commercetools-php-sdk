<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CartDiscount;

/**
 * @package Commercetools\Core\Model\CartDiscount
 *
 * @method string getType()
 * @method LineItemsTarget setType(string $type = null)
 * @method string getPredicate()
 * @method LineItemsTarget setPredicate(string $predicate = null)
 */
class LineItemsTarget extends CartDiscountTarget
{
    const TARGET_TYPE = 'lineItems';

    public static function ofPredicate($predicate, $context = null)
    {
        return static::of($context)->setPredicate($predicate);
    }
}
