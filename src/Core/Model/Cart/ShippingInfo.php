<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Order\DeliveryCollection;
use Commercetools\Core\Model\Order\ShippingInfoImportDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodReference;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\Common\TaxedItemPrice;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#shippinginfo
 *
 * @method string getShippingMethodName()
 * @method ShippingInfo setShippingMethodName(string $shippingMethodName = null)
 * @method Money getPrice()
 * @method ShippingInfo setPrice(Money $price = null)
 * @method ShippingRate getShippingRate()
 * @method ShippingInfo setShippingRate(ShippingRate $shippingRate = null)
 * @method TaxRate getTaxRate()
 * @method ShippingInfo setTaxRate(TaxRate $taxRate = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method ShippingInfo setTaxCategory(TaxCategoryReference $taxCategory = null)
 * @method ShippingMethodReference getShippingMethod()
 * @method ShippingInfo setShippingMethod(ShippingMethodReference $shippingMethod = null)
 * @method DeliveryCollection getDeliveries()
 * @method ShippingInfo setDeliveries(DeliveryCollection $deliveries = null)
 * @method DiscountedLineItemPrice getDiscountedPrice()
 * @method ShippingInfo setDiscountedPrice(DiscountedLineItemPrice $discountedPrice = null)
 * @method string getShippingMethodState()
 * @method ShippingInfo setShippingMethodState(string $shippingMethodState = null)
 * @method TaxedItemPrice getTaxedPrice()
 * @method ShippingInfo setTaxedPrice(TaxedItemPrice $taxedPrice = null)
 */
class ShippingInfo extends ShippingInfoImportDraft
{
    public function fieldDefinitions()
    {
        $fields = parent::fieldDefinitions();
        $fields['shippingMethodState'] = [static::TYPE => 'string'];
        $fields['taxedPrice'] = [static::TYPE => TaxedItemPrice::class, static::OPTIONAL => true];

        return $fields;
    }
}
