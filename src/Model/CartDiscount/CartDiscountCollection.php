<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CartDiscount;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\CartDiscount
 * @link https://dev.commercetools.com/http-api-projects-cartDiscounts.html#cartdiscount
 * @method CartDiscount current()
 * @method CartDiscountCollection add(CartDiscount $element)
 * @method CartDiscount getAt($offset)
 */
class CartDiscountCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\CartDiscount\CartDiscount';
}
