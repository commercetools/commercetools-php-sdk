<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Order\ItemState;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\Common\TaxedItemPrice;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#customlineitem
 * @method string getId()
 * @method CustomLineItem setId(string $id = null)
 * @method LocalizedString getName()
 * @method CustomLineItem setName(LocalizedString $name = null)
 * @method Money getMoney()
 * @method CustomLineItem setMoney(Money $money = null)
 * @method string getSlug()
 * @method CustomLineItem setSlug(string $slug = null)
 * @method int getQuantity()
 * @method CustomLineItem setQuantity(int $quantity = null)
 * @method ItemState getState()
 * @method CustomLineItem setState(ItemState $state = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method CustomLineItem setTaxCategory(TaxCategoryReference $taxCategory = null)
 * @method TaxRate getTaxRate()
 * @method CustomLineItem setTaxRate(TaxRate $taxRate = null)
 * @method CustomFieldObject getCustom()
 * @method CustomLineItem setCustom(CustomFieldObject $custom = null)
 * @method Money getTotalPrice()
 * @method CustomLineItem setTotalPrice(Money $totalPrice = null)
 * @method DiscountedPricePerQuantityCollection getDiscountedPricePerQuantity()
 * @method TaxedItemPrice getTaxedPrice()
 * @method CustomLineItem setTaxedPrice(TaxedItemPrice $taxedPrice = null)
 */
class CustomLineItem extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class],
            'money' => [static::TYPE => Money::class],
            'taxedPrice' => [static::TYPE => TaxedItemPrice::class],
            'slug' => [static::TYPE => 'string'],
            'quantity' => [static::TYPE => 'int'],
            'state' => [static::TYPE => ItemState::class],
            'taxCategory' => [static::TYPE => TaxCategoryReference::class],
            'taxRate' => [static::TYPE => TaxRate::class],
            'custom' => [static::TYPE => CustomFieldObject::class],
            'totalPrice' => [static::TYPE => Money::class],
            'discountedPricePerQuantity' => [
                static::TYPE => DiscountedPricePerQuantityCollection::class
            ],
        ];
    }

    /**
     * @param DiscountedPricePerQuantityCollection $discountedPricePerQuantity
     * @return static
     */
    public function setDiscountedPricePerQuantity(
        DiscountedPricePerQuantityCollection $discountedPricePerQuantity = null
    ) {
        return parent::setDiscountedPricePerQuantity($discountedPricePerQuantity);
    }
}
