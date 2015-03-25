<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts;


use Sphere\Core\Client\JsonEndpoint;

/**
 * Class CartDiscountsEndpoint
 * @package Sphere\Core\Request\CartDiscounts
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
