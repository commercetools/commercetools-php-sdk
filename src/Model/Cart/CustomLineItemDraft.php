<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Order\ItemState;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\CustomField\CustomFieldObject;

/**
 * @package Commercetools\Core\Model\Cart
 * @apidoc http://dev.sphere.io/http-api-projects-carts.html#custom-line-item
 * @method LocalizedString getName()
 * @method CustomLineItemDraft setName(LocalizedString $name = null)
 * @method Money getMoney()
 * @method CustomLineItemDraft setMoney(Money $money = null)
 * @method LocalizedString getSlug()
 * @method CustomLineItemDraft setSlug(LocalizedString $slug = null)
 * @method int getQuantity()
 * @method CustomLineItemDraft setQuantity(int $quantity = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method CustomLineItemDraft setTaxCategory(TaxCategoryReference $taxCategory = null)
 * @method CustomFieldObject getCustom()
 * @method CustomLineItemDraft setCustom(CustomFieldObject $custom = null)
 */
class CustomLineItemDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'name' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'money' => [static::TYPE => '\Commercetools\Core\Model\Common\Money'],
            'slug' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'quantity' => [static::TYPE => 'int'],
            'taxCategory' => [static::TYPE => '\Commercetools\Core\Model\TaxCategory\TaxCategoryReference'],
            'custom' => [static::TYPE => '\Commercetools\Core\Model\CustomField\CustomFieldObject'],
        ];
    }
}
