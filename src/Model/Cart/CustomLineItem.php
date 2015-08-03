<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Order\ItemState;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\TaxCategory\TaxRate;

/**
 * @package Commercetools\Core\Model\Cart
 * @apidoc http://dev.sphere.io/http-api-projects-carts.html#custom-line-item
 * @method string getId()
 * @method CustomLineItem setId(string $id = null)
 * @method LocalizedString getName()
 * @method CustomLineItem setName(LocalizedString $name = null)
 * @method Money getMoney()
 * @method CustomLineItem setMoney(Money $money = null)
 * @method LocalizedString getSlug()
 * @method CustomLineItem setSlug(LocalizedString $slug = null)
 * @method int getQuantity()
 * @method CustomLineItem setQuantity(int $quantity = null)
 * @method ItemState getState()
 * @method CustomLineItem setState(ItemState $state = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method CustomLineItem setTaxCategory(TaxCategoryReference $taxCategory = null)
 * @method TaxRate getTaxRate()
 * @method CustomLineItem setTaxRate(TaxRate $taxRate = null)
 */
class CustomLineItem extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'name' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'money' => [static::TYPE => '\Commercetools\Core\Model\Common\Money'],
            'slug' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'quantity' => [static::TYPE => 'int'],
            'state' => [static::TYPE => '\Commercetools\Core\Model\Order\ItemState'],
            'taxCategory' => [static::TYPE => '\Commercetools\Core\Model\TaxCategory\TaxCategoryReference'],
            'taxRate' => [static::TYPE => '\Commercetools\Core\Model\TaxCategory\TaxRate'],
        ];
    }
}
