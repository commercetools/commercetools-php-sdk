<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CartDiscount;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\CartDiscount
 * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#cartdiscount
 * @method CartDiscount current()
 * @method CartDiscountCollection add(CartDiscount $element)
 * @method CartDiscount getAt($offset)
 * @method CartDiscount getById($offset)
 */
class CartDiscountCollection extends Collection
{
    protected $type = CartDiscount::class;
}
