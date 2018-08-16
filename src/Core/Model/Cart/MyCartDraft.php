<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocaleTrait;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodReference;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-me-carts.html#mycartdraft
 * @method string getCurrency()
 * @method MyCartDraft setCurrency(string $currency = null)
 * @method string getCustomerEmail()
 * @method MyCartDraft setCustomerEmail(string $customerEmail = null)
 * @method string getCountry()
 * @method MyCartDraft setCountry(string $country = null)
 * @method string getInventoryMode()
 * @method MyCartDraft setInventoryMode(string $inventoryMode = null)
 * @method MyLineItemDraftCollection getLineItems()
 * @method MyCartDraft setLineItems(MyLineItemDraftCollection $lineItems = null)
 * @method Address getShippingAddress()
 * @method MyCartDraft setShippingAddress(Address $shippingAddress = null)
 * @method Address getBillingAddress()
 * @method MyCartDraft setBillingAddress(Address $billingAddress = null)
 * @method ShippingMethodReference getShippingMethod()
 * @method MyCartDraft setShippingMethod(ShippingMethodReference $shippingMethod = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method MyCartDraft setCustom(CustomFieldObjectDraft $custom = null)
 * @method string getLocale()
 * @method int getDeleteDaysAfterLastModification()
 * @method MyCartDraft setDeleteDaysAfterLastModification(int $deleteDaysAfterLastModification = null)
 * @method string getTaxMode()
 * @method MyCartDraft setTaxMode(string $taxMode = null)
 * @method AddressCollection getItemShippingAddresses()
 * @method MyCartDraft setItemShippingAddresses(AddressCollection $itemShippingAddresses = null)
 */
class MyCartDraft extends JsonObject
{
    use LocaleTrait;

    public function fieldDefinitions()
    {
        return [
            'currency' => [static::TYPE => 'string'],
            'customerEmail' => [static::TYPE => 'string'],
            'country' => [static::TYPE => 'string'],
            'inventoryMode' => [static::TYPE => 'string'],
            'lineItems' => [static::TYPE => MyLineItemDraftCollection::class],
            'shippingAddress' => [static::TYPE => Address::class],
            'billingAddress' => [static::TYPE => Address::class],
            'shippingMethod' => [static::TYPE => ShippingMethodReference::class],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
            'locale' => [static::TYPE => 'string'],
            'deleteDaysAfterLastModification' => [static::TYPE => 'int'],
            'taxMode' => [static::TYPE => 'string'],
            'itemShippingAddresses' => [static::TYPE => AddressCollection::class],
        ];
    }

    /**
     * @param string $currency
     * @param Context|callable $context
     * @return MyCartDraft
     */
    public static function ofCurrency($currency, $context = null)
    {
        $draft = static::of($context);
        return $draft->setCurrency($currency);
    }
}
