<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;

/**
 * @package Sphere\Core\Model\Cart
 * @link http://dev.sphere.io/http-api-projects-carts.html#discount-code-state
 */
class CartDiscountCodeState
{
    const NOT_ACTIVE = 'NotActive';
    const DOES_NOT_MATCH_CART = 'DoesNotMatchCart';
    const MATCHES_CART = 'MatchesCart';
    const MAX_APPLICATION_REACHED = 'MaxApplicationReached';
}
