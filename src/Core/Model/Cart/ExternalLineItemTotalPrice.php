<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\DiscountCode\DiscountCodeReference;
use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://dev.commercetools.com/http-api-projects-carts.html#externallineitemtotalprice
 * @method Money getPrice()
 * @method ExternalLineItemTotalPrice setPrice(Money $price = null)
 * @method Money getTotalPrice()
 * @method ExternalLineItemTotalPrice setTotalPrice(Money $totalPrice = null)
 */
class ExternalLineItemTotalPrice extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'price' => [static::TYPE => Money::class],
            'totalPrice' => [static::TYPE => Money::class]
        ];
    }
}
