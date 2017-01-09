<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\LocaleTrait;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\TaxedPrice;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Payment\PaymentInfo;
use DateTime;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://dev.commercetools.com/http-api-projects-carts.html#cart
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
 * @method CartReference getReference()
 */
class Cart extends Resource
{
    use LocaleTrait;

    const TAX_MODE_PLATFORM = 'Platform';
    const TAX_MODE_EXTERNAL = 'External';
    const TAX_MODE_DISABLED = 'Disabled';

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
            'customerId' => [static::TYPE => 'string'],
            'customerEmail' => [static::TYPE => 'string'],
            'lineItems' => [static::TYPE => LineItemCollection::class],
            'customLineItems' => [static::TYPE => CustomLineItemCollection::class],
            'totalPrice' => [static::TYPE => Money::class],
            'taxedPrice' => [static::TYPE => TaxedPrice::class],
            'cartState' => [static::TYPE => 'string'],
            'shippingAddress' => [static::TYPE => Address::class],
            'billingAddress' => [static::TYPE => Address::class],
            'inventoryMode' => [static::TYPE => 'string'],
            'customerGroup' => [static::TYPE => CustomerGroupReference::class],
            'country' => [static::TYPE => 'string'],
            'shippingInfo' => [static::TYPE => ShippingInfo::class],
            'discountCodes' => [static::TYPE => DiscountCodeInfoCollection::class],
            'custom' => [static::TYPE => CustomFieldObject::class],
            'paymentInfo' => [static::TYPE => PaymentInfo::class],
            'taxMode' => [static::TYPE => 'string'],
            'anonymousId' => [static::TYPE => 'string'],
            'locale' => [static::TYPE => 'string'],
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
