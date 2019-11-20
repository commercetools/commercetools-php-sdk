<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocaleTrait;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodReference;
use Commercetools\Core\Model\Store\StoreReference;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#cartdraft
 * @method string getCurrency()
 * @method string getCustomerId()
 * @method string getCountry()
 * @method string getInventoryMode()
 * @method CartDraft setCurrency(string $currency = null)
 * @method CartDraft setCustomerId(string $customerId = null)
 * @method CartDraft setCountry(string $country = null)
 * @method CartDraft setInventoryMode(string $inventoryMode = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method CartDraft setCustom(CustomFieldObjectDraft $custom = null)
 * @method string getCustomerEmail()
 * @method CartDraft setCustomerEmail(string $customerEmail = null)
 * @method LineItemDraftCollection getLineItems()
 * @method CartDraft setLineItems(LineItemDraftCollection $lineItems = null)
 * @method Address getShippingAddress()
 * @method CartDraft setShippingAddress(Address $shippingAddress = null)
 * @method Address getBillingAddress()
 * @method CartDraft setBillingAddress(Address $billingAddress = null)
 * @method ShippingMethodReference getShippingMethod()
 * @method CartDraft setShippingMethod(ShippingMethodReference $shippingMethod = null)
 * @method CustomLineItemDraftCollection getCustomLineItems()
 * @method CartDraft setCustomLineItems(CustomLineItemDraftCollection $customLineItems = null)
 * @method string getTaxMode()
 * @method CartDraft setTaxMode(string $taxMode = null)
 * @method string getAnonymousId()
 * @method CartDraft setAnonymousId(string $anonymousId = null)
 * @method string getLocale()
 * @method string getTaxRoundingMode()
 * @method CartDraft setTaxRoundingMode(string $taxRoundingMode = null)
 * @method int getDeleteDaysAfterLastModification()
 * @method CartDraft setDeleteDaysAfterLastModification(int $deleteDaysAfterLastModification = null)
 * @method CustomerGroupReference getCustomerGroup()
 * @method CartDraft setCustomerGroup(CustomerGroupReference $customerGroup = null)
 * @method string getOrigin()
 * @method CartDraft setOrigin(string $origin = null)
 * @method string getTaxCalculationMode()
 * @method CartDraft setTaxCalculationMode(string $taxCalculationMode = null)
 * @method ExternalTaxRateDraft getExternalTaxRateForShippingMethod()
 * @method CartDraft setExternalTaxRateForShippingMethod(ExternalTaxRateDraft $externalTaxRateForShippingMethod = null)
 * @method ShippingRateInputDraft getShippingRateInput()
 * @method CartDraft setShippingRateInput(ShippingRateInputDraft $shippingRateInput = null)
 * @method AddressCollection getItemShippingAddresses()
 * @method CartDraft setItemShippingAddresses(AddressCollection $itemShippingAddresses = null)
 * @method StoreReference getStore()
 * @method CartDraft setStore(StoreReference $store = null)
 */
class CartDraft extends JsonObject
{
    use LocaleTrait;

    public function fieldDefinitions()
    {
        return [
            'currency' => [static::TYPE => 'string'],
            'customerId' => [static::TYPE => 'string'],
            'customerEmail' => [static::TYPE => 'string'],
            'country' => [static::TYPE => 'string'],
            'inventoryMode' => [static::TYPE => 'string'],
            'lineItems' => [static::TYPE => LineItemDraftCollection::class],
            'customLineItems' => [static::TYPE => CustomLineItemDraftCollection::class],
            'shippingAddress' => [static::TYPE => Address::class],
            'billingAddress' => [static::TYPE => Address::class],
            'shippingMethod' => [static::TYPE => ShippingMethodReference::class],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
            'taxMode' => [static::TYPE => 'string'],
            'anonymousId' => [static::TYPE => 'string'],
            'locale' => [static::TYPE => 'string'],
            'taxRoundingMode' => [static::TYPE => 'string'],
            'deleteDaysAfterLastModification' => [static::TYPE => 'int'],
            'customerGroup' => [static::TYPE => CustomerGroupReference::class],
            'origin' => [static::TYPE => 'string'],
            'taxCalculationMode' => [static::TYPE => 'string'],
            'externalTaxRateForShippingMethod' => [static::TYPE => ExternalTaxRateDraft::class],
            'shippingRateInput' => [static::TYPE => ShippingRateInputDraft::class],
            'itemShippingAddresses' => [static::TYPE => AddressCollection::class],
            'store' => [static::TYPE => StoreReference::class],
        ];
    }

    /**
     * @param string $currency
     * @param Context|callable $context
     * @return CartDraft
     */
    public static function ofCurrency($currency, $context = null)
    {
        $draft = static::of($context);
        return $draft->setCurrency($currency);
    }

    /**
     * @param string $currency
     * @param string $country
     * @param Context|callable $context
     * @return CartDraft
     */
    public static function ofCurrencyAndShippingCountry($currency, $country, $context = null)
    {
        $draft = static::of($context);

        return $draft->setCurrency($currency)
            ->setCountry($country)
            ->setShippingAddress(Address::of()->setCountry($country));
    }
}
