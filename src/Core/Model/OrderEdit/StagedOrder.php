<?php
/**
 *
 */

namespace Commercetools\Core\Model\OrderEdit;

use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Cart\LineItemCollection;
use Commercetools\Core\Model\Cart\CustomLineItemCollection;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\TaxedPrice;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\Cart\ShippingInfo;
use Commercetools\Core\Model\Order\SyncInfoCollection;
use Commercetools\Core\Model\Order\ReturnInfoCollection;
use Commercetools\Core\Model\Cart\DiscountCodeInfoCollection;
use Commercetools\Core\Model\Cart\CartReference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\State\StateReference;
use Commercetools\Core\Model\Payment\PaymentInfo;
use Commercetools\Core\Model\Cart\ShippingRateInput;
use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Store\StoreReference;

/**
 * @package Commercetools\Core\Model\OrderEdit
 *
 * @method string getId()
 * @method StagedOrder setId(string $id = null)
 * @method int getVersion()
 * @method StagedOrder setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method StagedOrder setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method StagedOrder setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method DateTimeDecorator getCompletedAt()
 * @method StagedOrder setCompletedAt(DateTime $completedAt = null)
 * @method string getOrderNumber()
 * @method StagedOrder setOrderNumber(string $orderNumber = null)
 * @method string getCustomerId()
 * @method StagedOrder setCustomerId(string $customerId = null)
 * @method string getCustomerEmail()
 * @method StagedOrder setCustomerEmail(string $customerEmail = null)
 * @method LineItemCollection getLineItems()
 * @method StagedOrder setLineItems(LineItemCollection $lineItems = null)
 * @method CustomLineItemCollection getCustomLineItems()
 * @method StagedOrder setCustomLineItems(CustomLineItemCollection $customLineItems = null)
 * @method Money getTotalPrice()
 * @method StagedOrder setTotalPrice(Money $totalPrice = null)
 * @method TaxedPrice getTaxedPrice()
 * @method StagedOrder setTaxedPrice(TaxedPrice $taxedPrice = null)
 * @method Address getShippingAddress()
 * @method StagedOrder setShippingAddress(Address $shippingAddress = null)
 * @method Address getBillingAddress()
 * @method StagedOrder setBillingAddress(Address $billingAddress = null)
 * @method string getInventoryMode()
 * @method StagedOrder setInventoryMode(string $inventoryMode = null)
 * @method CustomerGroupReference getCustomerGroup()
 * @method StagedOrder setCustomerGroup(CustomerGroupReference $customerGroup = null)
 * @method string getCountry()
 * @method StagedOrder setCountry(string $country = null)
 * @method string getOrderState()
 * @method StagedOrder setOrderState(string $orderState = null)
 * @method string getShipmentState()
 * @method StagedOrder setShipmentState(string $shipmentState = null)
 * @method string getPaymentState()
 * @method StagedOrder setPaymentState(string $paymentState = null)
 * @method ShippingInfo getShippingInfo()
 * @method StagedOrder setShippingInfo(ShippingInfo $shippingInfo = null)
 * @method SyncInfoCollection getSyncInfo()
 * @method StagedOrder setSyncInfo(SyncInfoCollection $syncInfo = null)
 * @method ReturnInfoCollection getReturnInfo()
 * @method StagedOrder setReturnInfo(ReturnInfoCollection $returnInfo = null)
 * @method DiscountCodeInfoCollection getDiscountCodes()
 * @method StagedOrder setDiscountCodes(DiscountCodeInfoCollection $discountCodes = null)
 * @method int getLastMessageSequenceNumber()
 * @method StagedOrder setLastMessageSequenceNumber(int $lastMessageSequenceNumber = null)
 * @method CartReference getCart()
 * @method StagedOrder setCart(CartReference $cart = null)
 * @method CustomFieldObject getCustom()
 * @method StagedOrder setCustom(CustomFieldObject $custom = null)
 * @method StateReference getState()
 * @method StagedOrder setState(StateReference $state = null)
 * @method PaymentInfo getPaymentInfo()
 * @method StagedOrder setPaymentInfo(PaymentInfo $paymentInfo = null)
 * @method string getAnonymousId()
 * @method StagedOrder setAnonymousId(string $anonymousId = null)
 * @method string getLocale()
 * @method string getTaxRoundingMode()
 * @method StagedOrder setTaxRoundingMode(string $taxRoundingMode = null)
 * @method string getOrigin()
 * @method StagedOrder setOrigin(string $origin = null)
 * @method string getTaxCalculationMode()
 * @method StagedOrder setTaxCalculationMode(string $taxCalculationMode = null)
 * @method string getTaxMode()
 * @method StagedOrder setTaxMode(string $taxMode = null)
 * @method ShippingRateInput getShippingRateInput()
 * @method StagedOrder setShippingRateInput(ShippingRateInput $shippingRateInput = null)
 * @method AddressCollection getItemShippingAddresses()
 * @method StagedOrder setItemShippingAddresses(AddressCollection $itemShippingAddresses = null)
 * @method StoreReference getStore()
 * @method StagedOrder setStore(StoreReference $store = null)
 */
class StagedOrder extends Order
{

}
