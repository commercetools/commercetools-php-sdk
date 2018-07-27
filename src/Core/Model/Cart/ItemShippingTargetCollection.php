<?php
/**
 *
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Cart
 *
 * @method ItemShippingTargetCollection add(ItemShippingTarget $element)
 * @method ItemShippingTarget current()
 * @method ItemShippingTarget getAt($offset)
 */
class ItemShippingTargetCollection extends Collection
{
    protected $type = ItemShippingTarget::class;
}
