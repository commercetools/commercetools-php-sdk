<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;


class CartDiscountCodeState
{
    const NOT_ACTIVE = 'NotActive';
    const DOES_NOT_MATCH_CART = 'DoesNotMatchCart';
    const MATCHES_CART = 'MatchesCart';
    const MAX_APPLICATION_REACHED = 'MaxApplicationReached';
}
