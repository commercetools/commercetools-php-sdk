<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Order\DeliveryCollection;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodReference;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\Common\TaxedItemPrice;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#shippinginfo
 * @method string getShippingMethodName()
 * @method ShippingInfo setShippingMethodName(string $shippingMethodName = null)
 * @method Money getPrice()
 * @method ShippingInfo setPrice(Money $price = null)
 * @method ShippingRate getShippingRate()
 * @method ShippingInfo setShippingRate(ShippingRate $shippingRate = null)
 * @method TaxRate getTaxRate()
 * @method ShippingInfo setTaxRate(TaxRate $taxRate = null)
 * @method TaxCategory getTaxCategory()
 * @method ShippingInfo setTaxCategory(TaxCategory $taxCategory = null)
 * @method ShippingMethodReference getShippingMethod()
 * @method ShippingInfo setShippingMethod(ShippingMethodReference $shippingMethod = null)
 * @method DeliveryCollection getDeliveries()
 * @method ShippingInfo setDeliveries(DeliveryCollection $deliveries = null)
 * @method TaxedItemPrice getTaxedPrice()
 * @method ShippingInfo setTaxedPrice(TaxedItemPrice $taxedPrice = null)
 * @method DiscountedLineItemPrice getDiscountedPrice()
 * @method ShippingInfo setDiscountedPrice(DiscountedLineItemPrice $discountedPrice = null)
 * @method string getShippingMethodState()
 * @method ShippingInfo setShippingMethodState(string $shippingMethodState = null)
 */
class ShippingInfo extends JsonObject
{
    const SHIPPING_METHOD_MATCH = 'MatchesCart';
    const SHIPPING_METHOD_DONT_MATCH = 'DoesNotMatchCart';

    public function fieldDefinitions()
    {
        return [
            'shippingMethodName' => [static::TYPE => 'string'],
            'price' => [static::TYPE => Money::class],
            'shippingRate' => [static::TYPE => ShippingRate::class],
            'taxedPrice' => [static::TYPE => TaxedItemPrice::class],
            'taxRate' => [static::TYPE => TaxRate::class],
            'taxCategory' => [static::TYPE => TaxCategory::class],
            'shippingMethod' => [static::TYPE => ShippingMethodReference::class],
            'deliveries' => [static::TYPE => DeliveryCollection::class],
            'discountedPrice' => [static::TYPE => DiscountedLineItemPrice::class],
            'shippingMethodState' => [static::TYPE => 'string']
        ];
    }
}
