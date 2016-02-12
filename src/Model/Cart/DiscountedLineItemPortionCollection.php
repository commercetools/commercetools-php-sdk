<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://dev.commercetools.com/http-api-projects-carts.html#discounted-line-item-portion
 * @method DiscountedLineItemPortion current()
 * @method DiscountedLineItemPortionCollection add(DiscountedLineItemPortion $element)
 * @method DiscountedLineItemPortion getAt($offset)
 */
class DiscountedLineItemPortionCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Cart\DiscountedLineItemPortion';
}
