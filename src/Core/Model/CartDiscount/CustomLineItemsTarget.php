<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CartDiscount;

/**
 * @package Commercetools\Core\Model\CartDiscount
 *
 * @method string getType()
 * @method CustomLineItemsTarget setType(string $type = null)
 * @method string getPredicate()
 * @method CustomLineItemsTarget setPredicate(string $predicate = null)
 */
class CustomLineItemsTarget extends CartDiscountTarget
{
    const TARGET_TYPE = 'customLineItems';

    public static function ofPredicate($predicate, $context = null)
    {
        return static::of($context)->setPredicate($predicate);
    }
}
