<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\Money;
use Sphere\Core\Model\Order\DeliveryCollection;
use Sphere\Core\Model\ShippingMethod\ShippingMethodReference;
use Sphere\Core\Model\ShippingMethod\ShippingRate;
use Sphere\Core\Model\TaxCategory\TaxCategory;
use Sphere\Core\Model\TaxCategory\TaxRate;

/**
 * Class ShippingInfo
 * @package Sphere\Core\Model\Cart
 * @method string getShippingMethodName()
 * @method ShippingInfo setShippingMethodName(string $shippingMethodName)
 * @method Money getPrice()
 * @method ShippingInfo setPrice(Money $price)
 * @method ShippingRate getShippingRate()
 * @method ShippingInfo setShippingRate(ShippingRate $shippingRate)
 * @method TaxRate getTaxRate()
 * @method ShippingInfo setTaxRate(TaxRate $taxRate)
 * @method TaxCategory getTaxCategory()
 * @method ShippingInfo setTaxCategory(TaxCategory $taxCategory)
 * @method ShippingMethodReference getShippingMethod()
 * @method ShippingInfo setShippingMethod(ShippingMethodReference $shippingMethod)
 * @method DeliveryCollection getDeliveries()
 * @method ShippingInfo setDeliveries(DeliveryCollection $deliveries)
 */
class ShippingInfo extends JsonObject
{
    public function getFields()
    {
        return [
            'shippingMethodName' => [static::TYPE => 'string'],
            'price' => [static::TYPE => '\Sphere\Core\Model\Common\Money'],
            'shippingRate' => [static::TYPE => '\Sphere\Core\Model\ShippingMethod\ShippingRate'],
            'taxRate' => [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxRate'],
            'taxCategory' => [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxCategory'],
            'shippingMethod' => [static::TYPE => '\Sphere\Core\Model\ShippingMethod\ShippingMethodReference'],
            'deliveries' => [static::TYPE => '\Sphere\Core\Model\Order\DeliveryCollection'],
        ];
    }
}
