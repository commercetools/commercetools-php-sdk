<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CartDiscount;

/**
 * @package Commercetools\Core\Model\CartDiscount
 * @ramlTestIgnoreFields('predicate')
 * @method string getType()
 * @method ShippingCostTarget setType(string $type = null)
 * @method string getPredicate()
 * @method ShippingCostTarget setPredicate(string $predicate = null)
 */
class ShippingCostTarget extends CartDiscountTarget
{
    const TARGET_TYPE = 'shipping';
}
