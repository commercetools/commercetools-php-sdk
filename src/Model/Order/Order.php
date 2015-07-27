<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Cart\CustomLineItemCollection;
use Sphere\Core\Model\Cart\LineItemCollection;
use Sphere\Core\Model\Cart\ShippingInfo;
use Sphere\Core\Model\Common\Address;
use Sphere\Core\Model\Common\Resource;
use Sphere\Core\Model\Common\Money;
use Sphere\Core\Model\Common\TaxedPrice;
use Sphere\Core\Model\CustomerGroup\CustomerGroupReference;
use Sphere\Core\Model\DiscountCode\DiscountCodeReferenceCollection;

/**
 * @package Sphere\Core\Model\Order
 * @link http://dev.sphere.io/http-api-projects-orders.html#order
 * @method string getId()
 * @method Order setId(string $id = null)
 * @method int getVersion()
 * @method Order setVersion(int $version = null)
 * @method \DateTime getCreatedAt()
 * @method Order setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method Order setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method string getOrderNumber()
 * @method Order setOrderNumber(string $orderNumber = null)
 * @method string getCustomerId()
 * @method Order setCustomerId(string $customerId = null)
 * @method string getCustomerEmail()
 * @method Order setCustomerEmail(string $customerEmail = null)
 * @method LineItemCollection getLineItems()
 * @method Order setLineItems(LineItemCollection $lineItems = null)
 * @method CustomLineItemCollection getCustomLineItems()
 * @method Order setCustomLineItems(CustomLineItemCollection $customLineItems = null)
 * @method Money getTotalPrice()
 * @method Order setTotalPrice(Money $totalPrice = null)
 * @method TaxedPrice getTaxedPrice()
 * @method Order setTaxedPrice(TaxedPrice $taxedPrice = null)
 * @method Address getShippingAddress()
 * @method Order setShippingAddress(Address $shippingAddress = null)
 * @method Address getBillingAddress()
 * @method Order setBillingAddress(Address $billingAddress = null)
 * @method string getInventoryMode()
 * @method Order setInventoryMode(string $inventoryMode = null)
 * @method CustomerGroupReference getCustomerGroup()
 * @method Order setCustomerGroup(CustomerGroupReference $customerGroup = null)
 * @method string getCountry()
 * @method Order setCountry(string $country = null)
 * @method string getOrderState()
 * @method Order setOrderState(string $orderState = null)
 * @method string getShipmentState()
 * @method Order setShipmentState(string $shipmentState = null)
 * @method string getPaymentState()
 * @method Order setPaymentState(string $paymentState = null)
 * @method ShippingInfo getShippingInfo()
 * @method Order setShippingInfo(ShippingInfo $shippingInfo = null)
 * @method SyncInfoCollection getSyncInfo()
 * @method Order setSyncInfo(SyncInfoCollection $syncInfo = null)
 * @method ReturnInfoCollection getReturnInfo()
 * @method Order setReturnInfo(ReturnInfoCollection $returnInfo = null)
 * @method DiscountCodeReferenceCollection getDiscountCodes()
 * @method Order setDiscountCodes(DiscountCodeReferenceCollection $discountCodes = null)
 * @method int getLastMessageSequenceNumber()
 * @method Order setLastMessageSequenceNumber(int $lastMessageSequenceNumber = null)
 */
class Order extends Resource
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'orderNumber' => [static::TYPE => 'string'],
            'customerId' => [static::TYPE => 'string'],
            'customerEmail' => [static::TYPE => 'string'],
            'lineItems' => [static::TYPE => '\Sphere\Core\Model\Cart\LineItemCollection'],
            'customLineItems' => [static::TYPE => '\Sphere\Core\Model\Cart\CustomLineItemCollection'],
            'totalPrice' => [static::TYPE => '\Sphere\Core\Model\Common\Money'],
            'taxedPrice' => [static::TYPE => '\Sphere\Core\Model\Common\TaxedPrice'],
            'shippingAddress' => [static::TYPE => '\Sphere\Core\Model\Common\Address'],
            'billingAddress' => [static::TYPE => '\Sphere\Core\Model\Common\Address'],
            'inventoryMode' => [static::TYPE => 'string'],
            'customerGroup' => [static::TYPE => '\Sphere\Core\Model\CustomerGroup\CustomerGroupReference'],
            'country' => [static::TYPE => 'string'],
            'orderState' => [static::TYPE => 'string'],
            'shipmentState' => [static::TYPE => 'string'],
            'paymentState' => [static::TYPE => 'string'],
            'shippingInfo' => [static::TYPE => '\Sphere\Core\Model\Cart\ShippingInfo'],
            'syncInfo' => [static::TYPE => '\Sphere\Core\Model\Order\SyncInfoCollection'],
            'returnInfo' => [static::TYPE => '\Sphere\Core\Model\Order\ReturnInfoCollection'],
            'discountCodes' => [static::TYPE => '\Sphere\Core\Model\DiscountCode\DiscountCodeReferenceCollection'],
            'lastMessageSequenceNumber' => [static::TYPE => 'int'],
        ];
    }
}
