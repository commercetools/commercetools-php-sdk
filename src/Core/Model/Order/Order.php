<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Cart\CustomLineItemCollection;
use Commercetools\Core\Model\Cart\LineItemCollection;
use Commercetools\Core\Model\Cart\ShippingInfo;
use Commercetools\Core\Model\Cart\ShippingRateInput;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\LocaleTrait;
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
use DateTime;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://docs.commercetools.com/http-api-projects-orders.html#order
 * @method string getId()
 * @method Order setId(string $id = null)
 * @method int getVersion()
 * @method Order setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Order setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method Order setLastModifiedAt(DateTime $lastModifiedAt = null)
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
 * @method DateTimeDecorator getCompletedAt()
 * @method Order setCompletedAt(DateTime $completedAt = null)
 * @method string getAnonymousId()
 * @method Order setAnonymousId(string $anonymousId = null)
 * @method string getLocale()
 * @method string getTaxRoundingMode()
 * @method Order setTaxRoundingMode(string $taxRoundingMode = null)
 * @method string getOrigin()
 * @method Order setOrigin(string $origin = null)
 * @method string getTaxCalculationMode()
 * @method Order setTaxCalculationMode(string $taxCalculationMode = null)
 * @method string getTaxMode()
 * @method Order setTaxMode(string $taxMode = null)
 * @method ShippingRateInput getShippingRateInput()
 * @method Order setShippingRateInput(ShippingRateInput $shippingRateInput = null)
 * @method OrderReference getReference()
 */
class Order extends Resource
{
    const TAX_MODE_PLATFORM = 'Platform';
    const TAX_MODE_EXTERNAL = 'External';
    const TAX_MODE_DISABLED = 'Disabled';
    const TAX_ROUNDING_MODE_HALF_EVEN = 'HalfEven';
    const TAX_ROUNDING_MODE_HALF_UP = 'HalfUp';
    const TAX_ROUNDING_MODE_HALF_DOWN = 'HalfDown';

    use LocaleTrait;

    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'completedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'orderNumber' => [static::TYPE => 'string'],
            'customerId' => [static::TYPE => 'string'],
            'customerEmail' => [static::TYPE => 'string'],
            'lineItems' => [static::TYPE => LineItemCollection::class],
            'customLineItems' => [static::TYPE => CustomLineItemCollection::class],
            'totalPrice' => [static::TYPE => Money::class],
            'taxedPrice' => [static::TYPE => TaxedPrice::class],
            'shippingAddress' => [static::TYPE => Address::class],
            'billingAddress' => [static::TYPE => Address::class],
            'inventoryMode' => [static::TYPE => 'string'],
            'customerGroup' => [static::TYPE => CustomerGroupReference::class],
            'country' => [static::TYPE => 'string'],
            'orderState' => [static::TYPE => 'string'],
            'shipmentState' => [static::TYPE => 'string'],
            'paymentState' => [static::TYPE => 'string'],
            'shippingInfo' => [static::TYPE => ShippingInfo::class],
            'syncInfo' => [static::TYPE => SyncInfoCollection::class],
            'returnInfo' => [static::TYPE => ReturnInfoCollection::class],
            'discountCodes' => [static::TYPE => DiscountCodeInfoCollection::class],
            'lastMessageSequenceNumber' => [static::TYPE => 'int'],
            'cart' => [static::TYPE => CartReference::class],
            'custom' => [static::TYPE => CustomFieldObject::class],
            'state' => [static::TYPE => StateReference::class],
            'paymentInfo' => [static::TYPE => PaymentInfo::class],
            'anonymousId' => [static::TYPE => 'string'],
            'locale' => [static::TYPE => 'string'],
            'taxRoundingMode' => [static::TYPE => 'string'],
            'origin' => [static::TYPE => 'string'],
            'taxCalculationMode' => [static::TYPE => 'string'],
            'taxMode' => [static::TYPE => 'string'],
            'shippingRateInput' => [static::TYPE => ShippingRateInput::class],
        ];
    }
}
