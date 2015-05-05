<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Cart\CustomLineItemCollection;
use Sphere\Core\Model\Common\Money;
use Sphere\Core\Model\Common\TaxedPrice;
use Sphere\Core\Model\Common\Address;
use Sphere\Core\Model\CustomerGroup\CustomerGroupReference;
use Sphere\Core\Model\Cart\ShippingInfo;

/**
 * Class ImportOrder
 * @package Sphere\Core\Model\Order
 * @method string getOrderNumder()
 * @method ImportOrder setOrderNumder(string $orderNumder = null)
 * @method string getCustomerId()
 * @method ImportOrder setCustomerId(string $customerId = null)
 * @method string getCustomerEmail()
 * @method ImportOrder setCustomerEmail(string $customerEmail = null)
 * @method ImportLineItemCollection getLineItems()
 * @method ImportOrder setLineItems(ImportLineItemCollection $lineItems = null)
 * @method CustomLineItemCollection getCustomLineItems()
 * @method ImportOrder setCustomLineItems(CustomLineItemCollection $customLineItems = null)
 * @method Money getTotalPrice()
 * @method ImportOrder setTotalPrice(Money $totalPrice = null)
 * @method TaxedPrice getTaxedPrice()
 * @method ImportOrder setTaxedPrice(TaxedPrice $taxedPrice = null)
 * @method Address getShippingAddress()
 * @method ImportOrder setShippingAddress(Address $shippingAddress = null)
 * @method Address getBillingAddress()
 * @method ImportOrder setBillingAddress(Address $billingAddress = null)
 * @method CustomerGroupReference getCustomerGroup()
 * @method ImportOrder setCustomerGroup(CustomerGroupReference $customerGroup = null)
 * @method string getCountry()
 * @method ImportOrder setCountry(string $country = null)
 * @method string getOrderState()
 * @method ImportOrder setOrderState(string $orderState = null)
 * @method string getShipmentState()
 * @method ImportOrder setShipmentState(string $shipmentState = null)
 * @method string getPaymentState()
 * @method ImportOrder setPaymentState(string $paymentState = null)
 * @method ShippingInfo getShippingInfo()
 * @method ImportOrder setShippingInfo(ShippingInfo $shippingInfo = null)
 * @method \DateTime getCompletedAt()
 * @method ImportOrder setCompletedAt(\DateTime $completedAt = null)
 */
class ImportOrder extends JsonObject
{
    public function getFields()
    {
        return [
            'orderNumber' => [static::TYPE => 'string'],
            'customerId' => [static::TYPE => 'string'],
            'customerEmail' => [static::TYPE => 'string'],
            'lineItems' => [static::TYPE => '\Sphere\Core\Model\Order\ImportLineItemCollection'],
            'customLineItems' => [static::TYPE => '\Sphere\Core\Model\Cart\CustomLineItemCollection'],
            'totalPrice' => [static::TYPE => '\Sphere\Core\Model\Common\Money'],
            'taxedPrice' => [static::TYPE => '\Sphere\Core\Model\Common\TaxedPrice'],
            'shippingAddress' => [static::TYPE => '\Sphere\Core\Model\Common\Address'],
            'billingAddress' => [static::TYPE => '\Sphere\Core\Model\Common\Address'],
            'customerGroup' => [static::TYPE => '\Sphere\Core\Model\CustomerGroup\CustomerGroupReference'],
            'country' => [static::TYPE => 'string'],
            'orderState' => [static::TYPE => 'string'],
            'shipmentState' => [static::TYPE => 'string'],
            'paymentState' => [static::TYPE => 'string'],
            'shippingInfo' => [static::TYPE => '\Sphere\Core\Model\Cart\ShippingInfo'],
            'completedAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Sphere\Core\Model\Common\DateTimeDecorator'
            ],
        ];
    }
}
