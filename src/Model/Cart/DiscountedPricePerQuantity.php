<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Cart
 * @apidoc http://dev.sphere.io/http-api-projects-carts.html#discounted-line-item-price-for-quantity
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
            'discountedPrice' => [static::TYPE => '\Commercetools\Core\Model\Cart\DiscountedLineItemPrice']
        ];
    }
}
