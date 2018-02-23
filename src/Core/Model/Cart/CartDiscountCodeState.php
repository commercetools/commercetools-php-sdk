<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#discountcodestate
 */
class CartDiscountCodeState
{
    const NOT_ACTIVE = 'NotActive';
    const DOES_NOT_MATCH_CART = 'DoesNotMatchCart';
    const MATCHES_CART = 'MatchesCart';
    const MAX_APPLICATION_REACHED = 'MaxApplicationReached';
}
