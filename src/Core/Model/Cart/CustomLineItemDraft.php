<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\HighPrecisionMoney;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\ResourceIdentifier;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#customlineitemdraft
 * @method LocalizedString getName()
 * @method CustomLineItemDraft setName(LocalizedString $name = null)
 * @method Money getMoney()
 * @method CustomLineItemDraft setMoney(Money $money = null)
 * @method string getSlug()
 * @method CustomLineItemDraft setSlug(string $slug = null)
 * @method int getQuantity()
 * @method CustomLineItemDraft setQuantity(int $quantity = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method CustomLineItemDraft setTaxCategory(TaxCategoryReference $taxCategory = null)
 * @method CustomFieldObject getCustom()
 * @method CustomLineItemDraft setCustom(CustomFieldObject $custom = null)
 * @method ExternalTaxRateDraft getExternalTaxRate()
 * @method CustomLineItemDraft setExternalTaxRate(ExternalTaxRateDraft $externalTaxRate = null)
 * @method AddressCollection getItemShippingAddresses()
 * @method CustomLineItemDraft setItemShippingAddresses(AddressCollection $itemShippingAddresses = null)
 * @method ItemShippingDetailsDraft getShippingDetails()
 * @method CustomLineItemDraft setShippingDetails(ItemShippingDetailsDraft $shippingDetails = null)
 */
class CustomLineItemDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'name' => [static::TYPE => LocalizedString::class],
            'money' => [static::TYPE => Money::class],
            'slug' => [static::TYPE => 'string'],
            'quantity' => [static::TYPE => 'int'],
            'taxCategory' => [static::TYPE => TaxCategoryReference::class],
            'externalTaxRate' => [static::TYPE => ExternalTaxRateDraft::class],
            'custom' => [static::TYPE => CustomFieldObject::class],
            'shippingDetails' => [static::TYPE => ItemShippingDetailsDraft::class],
        ];
    }

    /**
     * @param LocalizedString $name
     * @param Money|HighPrecisionMoney $money
     * @param string $slug
     * @param Context|callable $context
     * @return CustomLineItemDraft
     */
    public static function ofNameMoneyAndSlug(LocalizedString $name, Money $money, $slug, $context = null)
    {
        return static::of($context)->setName($name)
            ->setMoney($money)
            ->setSlug($slug);
    }

    /**
     * @param LocalizedString $name
     * @param Money|HighPrecisionMoney $money
     * @param string $slug
     * @param int $quantity
     * @param Context|callable $context
     * @return CustomLineItemDraft
     */
    public static function ofNameMoneySlugAndQuantity(
        LocalizedString $name,
        Money $money,
        $slug,
        $quantity,
        $context = null
    ) {
        return static::of($context)->setName($name)
            ->setMoney($money)
            ->setSlug($slug)
            ->setQuantity($quantity);
    }

    /**
     * @param LocalizedString $name
     * @param Money|HighPrecisionMoney $money
     * @param string $slug
     * @param ResourceIdentifier|TaxCategoryReference $taxCategory
     * @param Context|callable $context
     * @return CustomLineItemDraft
     */
    public static function ofNameMoneySlugAndTaxCategory(
        LocalizedString $name,
        Money $money,
        $slug,
        ResourceIdentifier $taxCategory,
        $context = null
    ) {
        return static::of($context)
            ->setName($name)
            ->setMoney($money)
            ->setSlug($slug)
            ->setTaxCategory($taxCategory);
    }

    /**
     * @param LocalizedString $name
     * @param Money|HighPrecisionMoney $money
     * @param string $slug
     * @param ResourceIdentifier|TaxCategoryReference $taxCategory
     * @param int $quantity
     * @param Context|callable $context
     * @return CustomLineItemDraft
     */
    public static function ofNameMoneySlugTaxCategoryAndQuantity(
        LocalizedString $name,
        Money $money,
        $slug,
        ResourceIdentifier $taxCategory,
        $quantity,
        $context = null
    ) {
        return static::of($context)
            ->setName($name)
            ->setMoney($money)
            ->setSlug($slug)
            ->setTaxCategory($taxCategory)
            ->setQuantity($quantity);
    }
}
