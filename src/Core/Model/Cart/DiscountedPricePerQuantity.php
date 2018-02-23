<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#discountedlineitempriceforquantity
 * @method int getQuantity()
 * @method DiscountedPricePerQuantity setQuantity(int $quantity = null)
 * @method DiscountedLineItemPrice getDiscountedPrice()
 * @method DiscountedPricePerQuantity setDiscountedPrice(DiscountedLineItemPrice $discountedPrice = null)
 */
class DiscountedPricePerQuantity extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'quantity' => [static::TYPE => 'int'],
            'discountedPrice' => [static::TYPE => DiscountedLineItemPrice::class]
        ];
    }

    /**
     * @return Money
     */
    public function getDiscountedTotal()
    {
        return Money::ofCurrencyAndAmount(
            $this->getDiscountedPrice()->getValue()->getCurrencyCode(),
            $this->getDiscountedPrice()->getValue()->getCentAmount() * $this->getQuantity()
        );
    }
}
