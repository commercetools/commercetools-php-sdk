<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;

use Sphere\Core\Model\Common\Address;
use Sphere\Core\Model\Common\Document;
use Sphere\Core\Model\Common\Money;
use Sphere\Core\Model\Common\TaxedPrice;
use Sphere\Core\Model\CustomerGroup\CustomerGroupReference;

/**
 * Class Cart
 * @package Sphere\Core\Model\Cart
 * @link http://dev.sphere.io/http-api-projects-carts.html#cart
 * @method string getId()
 * @method Cart setId(string $id = null)
 * @method int getVersion()
 * @method Cart setVersion(int $version = null)
 * @method \DateTime getCreatedAt()
 * @method Cart setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method Cart setLastModifiedAt(\DateTime $lastModifiedAt = null)
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
 * @method CartDiscountCodeReferenceCollection getDiscountCodes()
 * @method Cart setDiscountCodes(CartDiscountCodeReferenceCollection $discountCodes = null)
 */
class Cart extends Document
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
            'discountCodes' => [static::TYPE => '\Sphere\Core\Model\Cart\CartDiscountCodeReferenceCollection'],
        ];
    }
}
