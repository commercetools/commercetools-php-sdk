<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#customlineitem
 * @method CustomLineItem current()
 * @method CustomLineItemCollection add(CustomLineItem $element)
 * @method CustomLineItem getAt($offset)
 * @method CustomLineItem getById($offset)
 */
class CustomLineItemCollection extends Collection
{
    protected $type = CustomLineItem::class;
}
