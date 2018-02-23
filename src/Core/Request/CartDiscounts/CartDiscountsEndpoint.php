<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts;

use Commercetools\Core\Client\JsonEndpoint;

/**
 * @package Commercetools\Core\Request\CartDiscounts
 */
class CartDiscountsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('cart-discounts');
    }
}
