<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://dev.commercetools.com/http-api-projects-carts.html#discountcodereference
 * @method DiscountCodeInfo current()
 * @method DiscountCodeInfoCollection add(DiscountCodeInfo $element)
 * @method DiscountCodeInfo getAt($offset)
 */
class DiscountCodeInfoCollection extends Collection
{
    protected $type = DiscountCodeInfo::class;
}
