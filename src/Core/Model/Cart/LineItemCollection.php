<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#lineitem
 * @method LineItem current()
 * @method LineItemCollection add(LineItem $element)
 * @method LineItem getAt($offset)
 * @method LineItem getById($offset)
 */
class LineItemCollection extends Collection
{
    protected $type = LineItem::class;
}
