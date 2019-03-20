<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Cart\CustomLineItemCollection;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\TaxedPrice;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\Cart\ShippingInfo;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use DateTime;

/**
 * @package Commercetools\Core\Model\Order
 * @ramlTestIgnoreClass
 * @link https://docs.commercetools.com/http-api-projects-orders-import.html#orderimportdraft
 * @method string getOrderNumber()
 * @method ImportOrder setOrderNumber(string $orderNumber = null)
 * @method string getCustomerId()
 * @method ImportOrder setCustomerId(string $customerId = null)
 * @method string getCustomerEmail()
 * @method ImportOrder setCustomerEmail(string $customerEmail = null)
 * @method LineItemImportDraftCollection getLineItems()
 * @method ImportOrder setLineItems(LineItemImportDraftCollection $lineItems = null)
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
 * @method ShippingInfoImportDraft getShippingInfo()
 * @method ImportOrder setShippingInfo(ShippingInfoImportDraft $shippingInfo = null)
 * @method DateTimeDecorator getCompletedAt()
 * @method ImportOrder setCompletedAt(DateTime $completedAt = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method ImportOrder setCustom(CustomFieldObjectDraft $custom = null)
 * @method string getInventoryMode()
 * @method ImportOrder setInventoryMode(string $inventoryMode = null)
 * @method string getTaxRoundingMode()
 * @method ImportOrder setTaxRoundingMode(string $taxRoundingMode = null)
 * @method string getOrigin()
 * @method ImportOrder setOrigin(string $origin = null)
 * @method string getTaxCalculationMode()
 * @method ImportOrder setTaxCalculationMode(string $taxCalculationMode = null)
 * @method AddressCollection getItemShippingAddresses()
 * @method ImportOrder setItemShippingAddresses(AddressCollection $itemShippingAddresses = null)
 */
class ImportOrder extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'orderNumber' => [static::TYPE => 'string'],
            'customerId' => [static::TYPE => 'string'],
            'customerEmail' => [static::TYPE => 'string'],
            'lineItems' => [static::TYPE => LineItemImportDraftCollection::class],
            'customLineItems' => [static::TYPE => CustomLineItemCollection::class],
            'totalPrice' => [static::TYPE => Money::class],
            'taxedPrice' => [static::TYPE => TaxedPrice::class],
            'shippingAddress' => [static::TYPE => Address::class],
            'billingAddress' => [static::TYPE => Address::class],
            'customerGroup' => [static::TYPE => CustomerGroupReference::class],
            'country' => [static::TYPE => 'string'],
            'orderState' => [static::TYPE => 'string'],
            'shipmentState' => [static::TYPE => 'string'],
            'paymentState' => [static::TYPE => 'string'],
            'shippingInfo' => [static::TYPE => ShippingInfoImportDraft::class],
            'completedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
            'inventoryMode' => [static::TYPE => 'string'],
            'taxRoundingMode' => [static::TYPE => 'string'],
            'origin' => [static::TYPE => 'string'],
            'taxCalculationMode' => [static::TYPE => 'string'],
            'itemShippingAddresses' => [static::TYPE => AddressCollection::class],
        ];
    }
}
