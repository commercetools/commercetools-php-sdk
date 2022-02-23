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
 * @method array getDiscountCodes()
 * @method CartDraft setDiscountCodes(array $discountCodes = null)
 * @method string getKey()
 * @method CartDraft setKey(string $key = null)
 */
class CartDraft extends JsonObject
{
    use LocaleTrait;

    public function fieldDefinitions()
    {
        return [
            'currency' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string', static::OPTIONAL => true],
            'customerId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'customerEmail' => [static::TYPE => 'string', static::OPTIONAL => true],
            'country' => [static::TYPE => 'string', static::OPTIONAL => true],
            'inventoryMode' => [static::TYPE => 'string', static::OPTIONAL => true],
            'lineItems' => [static::TYPE => LineItemDraftCollection::class, static::OPTIONAL => true],
            'customLineItems' => [static::TYPE => CustomLineItemDraftCollection::class, static::OPTIONAL => true],
            'shippingAddress' => [static::TYPE => Address::class, static::OPTIONAL => true],
            'billingAddress' => [static::TYPE => Address::class, static::OPTIONAL => true],
            'shippingMethod' => [static::TYPE => ShippingMethodReference::class, static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class, static::OPTIONAL => true],
            'taxMode' => [static::TYPE => 'string', static::OPTIONAL => true],
            'anonymousId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'locale' => [static::TYPE => 'string', static::OPTIONAL => true],
            'taxRoundingMode' => [static::TYPE => 'string', static::OPTIONAL => true],
            'deleteDaysAfterLastModification' => [static::TYPE => 'int', static::OPTIONAL => true],
            'customerGroup' => [static::TYPE => CustomerGroupReference::class, static::OPTIONAL => true],
            'origin' => [static::TYPE => 'string', static::OPTIONAL => true],
            'taxCalculationMode' => [static::TYPE => 'string', static::OPTIONAL => true],
            'externalTaxRateForShippingMethod' => [static::TYPE => ExternalTaxRateDraft::class, static::OPTIONAL => true],
            'shippingRateInput' => [static::TYPE => ShippingRateInputDraft::class, static::OPTIONAL => true],
            'itemShippingAddresses' => [static::TYPE => AddressCollection::class, static::OPTIONAL => true],
            'store' => [static::TYPE => StoreReference::class, static::OPTIONAL => true],
            'discountCodes' => [static::TYPE => 'array', static::OPTIONAL => true],
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
