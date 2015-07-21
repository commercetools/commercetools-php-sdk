<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\Common\Money;
use Sphere\Core\Model\Order\ItemState;
use Sphere\Core\Model\TaxCategory\TaxCategoryReference;
use Sphere\Core\Model\TaxCategory\TaxRate;

/**
 * @package Sphere\Core\Model\Cart
 * @link http://dev.sphere.io/http-api-projects-carts.html#custom-line-item
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
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'money' => [static::TYPE => '\Sphere\Core\Model\Common\Money'],
            'slug' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'quantity' => [static::TYPE => 'int'],
            'state' => [static::TYPE => '\Sphere\Core\Model\Order\ItemState'],
            'taxCategory' => [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxCategoryReference'],
            'taxRate' => [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxRate'],
        ];
    }
}
