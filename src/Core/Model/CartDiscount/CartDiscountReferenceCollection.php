<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CartDiscount;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\CartDiscount
 * @link https://docs.commercetools.com/http-api-types.html#reference-types
 * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#cartdiscount
 * @method CartDiscountReference current()
 * @method CartDiscountReferenceCollection add(CartDiscountReference $element)
 * @method CartDiscountReference getAt($offset)
 * @method CartDiscountReference getById($offset)
 */
class CartDiscountReferenceCollection extends Collection
{
    protected $type = CartDiscountReference::class;
}
