<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Cart\CustomLineItemCollection;
use Commercetools\Core\Model\Cart\LineItemCollection;
use Commercetools\Core\Model\Cart\ShippingInfo;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\TaxedPrice;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\Cart\DiscountCodeInfoCollection;
use Commercetools\Core\Model\Cart\CartReference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\State\StateReference;
use Commercetools\Core\Model\Payment\PaymentInfo;

/**
 * @package Commercetools\Core\Model\Order
 * @link http://dev.commercetools.com/http-api-projects-orders.html#order
 * @method string getId()
 * @method Order setId(string $id = null)
 * @method int getVersion()
 * @method Order setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Order setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
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
 * @method DiscountCodeInfoCollection getDiscountCodes()
 * @method Order setDiscountCodes(DiscountCodeInfoCollection $discountCodes = null)
 * @method int getLastMessageSequenceNumber()
 * @method Order setLastMessageSequenceNumber(int $lastMessageSequenceNumber = null)
 * @method CartReference getCart()
 * @method Order setCart(CartReference $cart = null)
 * @method CustomFieldObject getCustom()
 * @method Order setCustom(CustomFieldObject $custom = null)
 * @method StateReference getState()
 * @method Order setState(StateReference $state = null)
 * @method PaymentInfo getPaymentInfo()
 * @method Order setPaymentInfo(PaymentInfo $paymentInfo = null)
 */
class Order extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'lastModifiedAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'orderNumber' => [static::TYPE => 'string'],
            'customerId' => [static::TYPE => 'string'],
            'customerEmail' => [static::TYPE => 'string'],
            'lineItems' => [static::TYPE => '\Commercetools\Core\Model\Cart\LineItemCollection'],
            'customLineItems' => [static::TYPE => '\Commercetools\Core\Model\Cart\CustomLineItemCollection'],
            'totalPrice' => [static::TYPE => '\Commercetools\Core\Model\Common\Money'],
            'taxedPrice' => [static::TYPE => '\Commercetools\Core\Model\Common\TaxedPrice'],
            'shippingAddress' => [static::TYPE => '\Commercetools\Core\Model\Common\Address'],
            'billingAddress' => [static::TYPE => '\Commercetools\Core\Model\Common\Address'],
            'inventoryMode' => [static::TYPE => 'string'],
            'customerGroup' => [static::TYPE => '\Commercetools\Core\Model\CustomerGroup\CustomerGroupReference'],
            'country' => [static::TYPE => 'string'],
            'orderState' => [static::TYPE => 'string'],
            'shipmentState' => [static::TYPE => 'string'],
            'paymentState' => [static::TYPE => 'string'],
            'shippingInfo' => [static::TYPE => '\Commercetools\Core\Model\Cart\ShippingInfo'],
            'syncInfo' => [static::TYPE => '\Commercetools\Core\Model\Order\SyncInfoCollection'],
            'returnInfo' => [static::TYPE => '\Commercetools\Core\Model\Order\ReturnInfoCollection'],
            'discountCodes' => [static::TYPE => '\Commercetools\Core\Model\Cart\DiscountCodeInfoCollection'],
            'lastMessageSequenceNumber' => [static::TYPE => 'int'],
            'cart' => [static::TYPE => '\Commercetools\Core\Model\Cart\CartReference'],
            'custom' => [static::TYPE => '\Commercetools\Core\Model\CustomField\CustomFieldObject'],
            'state' => [static::TYPE => '\Commercetools\Core\Model\State\StateReference'],
            'paymentInfo' => [static::TYPE => '\Commercetools\Core\Model\Payment\PaymentInfo'],
        ];
    }
}
