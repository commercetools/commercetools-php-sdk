<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#discountedlineitempriceforquantity
 * @method DiscountedPricePerQuantityCollection add(DiscountedPricePerQuantity $element)
 * @method DiscountedPricePerQuantity current()
 * @method DiscountedPricePerQuantity getAt($offset)
 */
class DiscountedPricePerQuantityCollection extends Collection
{
    protected $type = DiscountedPricePerQuantity::class;
}
