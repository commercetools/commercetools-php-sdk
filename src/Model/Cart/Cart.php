<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;

use Sphere\Core\Model\Common\Address;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\Money;
use Sphere\Core\Model\Common\TaxedPrice;
use Sphere\Core\Model\CustomerGroup\CustomerGroupReference;
use Sphere\Core\Model\DiscountCode\DiscountCodeReference;

/**
 * Class Cart
 * @package Sphere\Core\Model\Cart
 * @method string getId()
 * @method Cart setId(string $id)
 * @method int getVersion()
 * @method Cart setVersion(int $version)
 * @method \DateTime getCreatedAt()
 * @method Cart setCreatedAt(\DateTime $createdAt)
 * @method \DateTime getLastModifiedAt()
 * @method Cart setLastModifiedAt(\DateTime $lastModifiedAt)
 * @method string getCustomerId()
 * @method Cart setCustomerId(string $customerId)
 * @method string getCustomerEmail()
 * @method Cart setCustomerEmail(string $customerEmail)
 * @method LineItemCollection getLineItems()
 * @method Cart setLineItems(LineItemCollection $lineItems)
 * @method CustomLineItemCollection getCustomLineItems()
 * @method Cart setCustomLineItems(CustomLineItemCollection $customLineItems)
 * @method Money getTotalPrice()
 * @method Cart setTotalPrice(Money $totalPrice)
 * @method TaxedPrice getTaxedPrice()
 * @method Cart setTaxedPrice(TaxedPrice $taxedPrice)
 * @method string getCartState()
 * @method Cart setCartState(string $cartState)
 * @method Address getShippingAddress()
 * @method Cart setShippingAddress(Address $shippingAddress)
 * @method Address getBillingAddress()
 * @method Cart setBillingAddress(Address $billingAddress)
 * @method string getInventoryMode()
 * @method Cart setInventoryMode(string $inventoryMode)
 * @method CustomerGroupReference getCustomerGroup()
 * @method Cart setCustomerGroup(CustomerGroupReference $customerGroup)
 * @method string getCountry()
 * @method Cart setCountry(string $country)
 * @method ShippingInfo getShippingInfo()
 * @method Cart setShippingInfo(ShippingInfo $shippingInfo)
 * @method DiscountCodeReference getDiscountCodes()
 * @method Cart setDiscountCodes(DiscountCodeReference $discountCodes)
 */
class Cart extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'customerId' => [static::TYPE => 'string'],
            'customerEmail' => [static::TYPE => 'string'],
            'lineItems' => [static::TYPE => '\Sphere\Core\Model\Cart\LineItemCollection'],
            'customLineItems' => [static::TYPE => '\Sphere\Core\Model\Cart\CustomLineItemCollection'],
            'totalPrice' => [static::TYPE => '\Sphere\Core\Model\Common\Money'],
            'taxedPrice' => [static::TYPE => '\Sphere\Core\Model\Common\TaxedPrice'],
            'cartState' => [static::TYPE => 'string'],
            'shippingAddress' => [static::TYPE => '\Sphere\Core\Model\Common\Address'],
            'billingAddress' => [static::TYPE => '\Sphere\Core\Model\Common\Address'],
            'inventoryMode' => [static::TYPE => 'string'],
            'customerGroup' => [static::TYPE => '\Sphere\Core\Model\CustomerGroup\CustomerGroupReference'],
            'country' => [static::TYPE => 'string'],
            'shippingInfo' => [static::TYPE => '\Sphere\Core\Model\Cart\ShippingInfo'],
            'discountCodes' => [static::TYPE => '\Sphere\Core\Model\DiscountCode\DiscountCodeReference'],
        ];
    }
}
