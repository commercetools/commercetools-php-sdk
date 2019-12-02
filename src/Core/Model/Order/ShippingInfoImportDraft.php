<?php
/**
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Cart\DiscountedLineItemPrice;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodReference;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\TaxCategory\TaxRate;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://docs.commercetools.com/http-api-projects-orders-import.html#shippinginfoimportdraft
 *
 * @method string getShippingMethodName()
 * @method ShippingInfoImportDraft setShippingMethodName(string $shippingMethodName = null)
 * @method Money getPrice()
 * @method ShippingInfoImportDraft setPrice(Money $price = null)
 * @method ShippingRate getShippingRate()
 * @method ShippingInfoImportDraft setShippingRate(ShippingRate $shippingRate = null)
 * @method TaxRate getTaxRate()
 * @method ShippingInfoImportDraft setTaxRate(TaxRate $taxRate = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method ShippingInfoImportDraft setTaxCategory(TaxCategoryReference $taxCategory = null)
 * @method ShippingMethodReference getShippingMethod()
 * @method ShippingInfoImportDraft setShippingMethod(ShippingMethodReference $shippingMethod = null)
 * @method DeliveryCollection getDeliveries()
 * @method ShippingInfoImportDraft setDeliveries(DeliveryCollection $deliveries = null)
 * @method DiscountedLineItemPrice getDiscountedPrice()
 * @method ShippingInfoImportDraft setDiscountedPrice(DiscountedLineItemPrice $discountedPrice = null)
 * @method string getShippingMethodState()
 * @method ShippingInfoImportDraft setShippingMethodState(string $shippingMethodState = null)
 */
class ShippingInfoImportDraft extends JsonObject
{
    const SHIPPING_METHOD_MATCH = 'MatchesCart';
    const SHIPPING_METHOD_DONT_MATCH = 'DoesNotMatchCart';

    public function fieldDefinitions()
    {
        return [
            'shippingMethodName' => [static::TYPE => 'string'],
            'price' => [static::TYPE => Money::class],
            'shippingRate' => [static::TYPE => ShippingRate::class],
            'taxRate' => [static::TYPE => TaxRate::class],
            'taxCategory' => [static::TYPE => TaxCategoryReference::class],
            'shippingMethod' => [static::TYPE => ShippingMethodReference::class],
            'deliveries' => [static::TYPE => DeliveryCollection::class],
            'discountedPrice' => [static::TYPE => DiscountedLineItemPrice::class],
            'shippingMethodState' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param string $shippingMethodName
     * @param Money $price
     * @param ShippingRate $shippingRate
     * @param string $shippingMethodState
     * @param Context|callable $context
     * @return ShippingInfoImportDraft
     */
    public static function ofNamePriceRateAndState(
        $shippingMethodName,
        Money $price,
        ShippingRate $shippingRate,
        $shippingMethodState,
        $context = null
    ) {
        return static::of($context)
            ->setShippingMethodName($shippingMethodName)
            ->setPrice($price)
            ->setShippingRate($shippingRate)
            ->setShippingMethodState($shippingMethodState);
    }
}
