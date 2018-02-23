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
        ];
    }
}
