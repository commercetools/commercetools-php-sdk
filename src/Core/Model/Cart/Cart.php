<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\CartDiscount\CartDiscountReferenceCollection;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Common\LocaleTrait;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\TaxedPrice;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Payment\PaymentInfo;
use Commercetools\Core\Model\Store\StoreReference;
use DateTime;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#cart
 * @method string getId()
 * @method Cart setId(string $id = null)
 * @method int getVersion()
 * @method Cart setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Cart setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method Cart setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method string getCustomerId()
 * @method Cart setCustomerId(string $customerId = null)
 * @method string getCustomerEmail()
 * @method Cart setCustomerEmail(string $customerEmail = null)
 * @method LineItemCollection getLineItems()
 * @method Cart setLineItems(LineItemCollection $lineItems = null)
 * @method CustomLineItemCollection getCustomLineItems()
 * @method Cart setCustomLineItems(CustomLineItemCollection $customLineItems = null)
 * @method Money getTotalPrice()
 * @method Cart setTotalPrice(Money $totalPrice = null)
 * @method TaxedPrice getTaxedPrice()
 * @method Cart setTaxedPrice(TaxedPrice $taxedPrice = null)
 * @method string getCartState()
 * @method Cart setCartState(string $cartState = null)
 * @method Address getShippingAddress()
 * @method Cart setShippingAddress(Address $shippingAddress = null)
 * @method Address getBillingAddress()
 * @method Cart setBillingAddress(Address $billingAddress = null)
 * @method string getInventoryMode()
 * @method Cart setInventoryMode(string $inventoryMode = null)
 * @method CustomerGroupReference getCustomerGroup()
 * @method Cart setCustomerGroup(CustomerGroupReference $customerGroup = null)
 * @method string getCountry()
 * @method Cart setCountry(string $country = null)
 * @method ShippingInfo getShippingInfo()
 * @method Cart setShippingInfo(ShippingInfo $shippingInfo = null)
 * @method DiscountCodeInfoCollection getDiscountCodes()
 * @method Cart setDiscountCodes(DiscountCodeInfoCollection $discountCodes = null)
 * @method CustomFieldObject getCustom()
 * @method Cart setCustom(CustomFieldObject $custom = null)
 * @method PaymentInfo getPaymentInfo()
 * @method Cart setPaymentInfo(PaymentInfo $paymentInfo = null)
 * @method string getTaxMode()
 * @method Cart setTaxMode(string $taxMode = null)
 * @method string getAnonymousId()
 * @method Cart setAnonymousId(string $anonymousId = null)
 * @method string getLocale()
 * @method string getTaxRoundingMode()
 * @method Cart setTaxRoundingMode(string $taxRoundingMode = null)
 * @method int getDeleteDaysAfterLastModification()
 * @method Cart setDeleteDaysAfterLastModification(int $deleteDaysAfterLastModification = null)
 * @method CartDiscountReferenceCollection getRefusedGifts()
 * @method Cart setRefusedGifts(CartDiscountReferenceCollection $refusedGifts = null)
 * @method string getOrigin()
 * @method Cart setOrigin(string $origin = null)
 * @method string getTaxCalculationMode()
 * @method Cart setTaxCalculationMode(string $taxCalculationMode = null)
 * @method ShippingRateInput getShippingRateInput()
 * @method Cart setShippingRateInput(ShippingRateInput $shippingRateInput = null)
 * @method AddressCollection getItemShippingAddresses()
 * @method Cart setItemShippingAddresses(AddressCollection $itemShippingAddresses = null)
 * @method StoreReference getStore()
 * @method Cart setStore(StoreReference $store = null)
 * @method CreatedBy getCreatedBy()
 * @method Cart setCreatedBy(CreatedBy $createdBy = null)
 * @method LastModifiedBy getLastModifiedBy()
 * @method Cart setLastModifiedBy(LastModifiedBy $lastModifiedBy = null)
 * @method string getKey()
 * @method Cart setKey(string $key = null)
 * @method CartReference getReference()
 */
class Cart extends Resource
{
    use LocaleTrait;

    const TAX_MODE_PLATFORM = 'Platform';
    const TAX_MODE_EXTERNAL = 'External';
    const TAX_MODE_DISABLED = 'Disabled';
    const TAX_MODE_EXTERNAL_AMOUNT = 'ExternalAmount';
    const TAX_ROUNDING_MODE_HALF_EVEN = 'HalfEven';
    const TAX_ROUNDING_MODE_HALF_UP = 'HalfUp';
    const TAX_ROUNDING_MODE_HALF_DOWN = 'HalfDown';

    const ORIGIN_CUSTOMER = 'Customer';
    const ORIGIN_MERCHANT = 'Merchant';

    const TAX_CALCULATION_MODE_LINE_ITEM_LEVEL = 'LineItemLevel';
    const TAX_CALCULATION_MODE_UNIT_PRICE_LEVEL = 'UnitPriceLevel';

    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string', static::OPTIONAL => true],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'customerId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'customerEmail' => [static::TYPE => 'string', static::OPTIONAL => true],
            'lineItems' => [static::TYPE => LineItemCollection::class],
            'customLineItems' => [static::TYPE => CustomLineItemCollection::class],
            'totalPrice' => [static::TYPE => Money::class],
            'taxedPrice' => [static::TYPE => TaxedPrice::class, static::OPTIONAL => true],
            'cartState' => [static::TYPE => 'string'],
            'shippingAddress' => [static::TYPE => Address::class, static::OPTIONAL => true],
            'billingAddress' => [static::TYPE => Address::class, static::OPTIONAL => true],
            'inventoryMode' => [static::TYPE => 'string', static::OPTIONAL => true],
            'customerGroup' => [static::TYPE => CustomerGroupReference::class, static::OPTIONAL => true],
            'country' => [static::TYPE => 'string', static::OPTIONAL => true],
            'shippingInfo' => [static::TYPE => ShippingInfo::class, static::OPTIONAL => true],
            'discountCodes' => [static::TYPE => DiscountCodeInfoCollection::class, static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
            'paymentInfo' => [static::TYPE => PaymentInfo::class, static::OPTIONAL => true],
            'taxMode' => [static::TYPE => 'string'],
            'anonymousId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'locale' => [static::TYPE => 'string', static::OPTIONAL => true],
            'taxRoundingMode' => [static::TYPE => 'string'],
            'deleteDaysAfterLastModification' => [static::TYPE => 'int', static::OPTIONAL => true],
            'refusedGifts' => [static::TYPE => CartDiscountReferenceCollection::class],
            'origin' => [static::TYPE => 'string'],
            'taxCalculationMode' => [static::TYPE => 'string'],
            'shippingRateInput' => [static::TYPE => ShippingRateInput::class, static::OPTIONAL => true],
            'itemShippingAddresses' => [static::TYPE => AddressCollection::class, static::OPTIONAL => true],
            'store' => [static::TYPE => StoreReference::class, static::OPTIONAL => true],
            'createdBy' => [static::TYPE => CreatedBy::class, static::OPTIONAL => true],
            'lastModifiedBy' => [static::TYPE => LastModifiedBy::class, static::OPTIONAL => true],
        ];
    }

    public function getLineItemCount()
    {
        $count = 0;
        if ($this->getLineItems() instanceof LineItemCollection) {
            foreach ($this->getLineItems() as $lineItem) {
                $count+= $lineItem->getQuantity();
            }
            $this->getLineItems()->rewind();
        }
        return $count;
    }
}
