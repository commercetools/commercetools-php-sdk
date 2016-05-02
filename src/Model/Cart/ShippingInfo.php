<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
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
 * @link https://dev.commercetools.com/http-api-projects-carts.html#shipping-info
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
 */
class ShippingInfo extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'shippingMethodName' => [static::TYPE => 'string'],
            'price' => [static::TYPE => '\Commercetools\Core\Model\Common\Money'],
            'shippingRate' => [static::TYPE => '\Commercetools\Core\Model\ShippingMethod\ShippingRate'],
            'taxedPrice' => [static::TYPE => '\Commercetools\Core\Model\Common\TaxedItemPrice'],
            'taxRate' => [static::TYPE => '\Commercetools\Core\Model\TaxCategory\TaxRate'],
            'taxCategory' => [static::TYPE => '\Commercetools\Core\Model\TaxCategory\TaxCategory'],
            'shippingMethod' => [static::TYPE => '\Commercetools\Core\Model\ShippingMethod\ShippingMethodReference'],
            'deliveries' => [static::TYPE => '\Commercetools\Core\Model\Order\DeliveryCollection'],
            'discountedPrice' => [static::TYPE => '\Commercetools\Core\Model\Cart\DiscountedLineItemPrice'],
        ];
    }
}
