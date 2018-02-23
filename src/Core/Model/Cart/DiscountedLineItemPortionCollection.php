<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#discountedlineitemportion
 * @method DiscountedLineItemPortion current()
 * @method DiscountedLineItemPortionCollection add(DiscountedLineItemPortion $element)
 * @method DiscountedLineItemPortion getAt($offset)
 */
class DiscountedLineItemPortionCollection extends Collection
{
    protected $type = DiscountedLineItemPortion::class;
}
