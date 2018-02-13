<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#cart
 * @method Cart current()
 * @method CartCollection add(Cart $element)
 * @method Cart getAt($offset)
 * @method Cart getById($offset)
 */
class CartCollection extends Collection
{
    protected $type = Cart::class;
}
