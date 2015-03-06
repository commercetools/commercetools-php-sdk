<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\Common\Money;
use Sphere\Core\Model\Common\Price;
use Sphere\Core\Model\Product\ProductVariant;
use Sphere\Core\Model\TaxCategory\TaxRate;

/**
 * Class LineItem
 * @package Sphere\Core\Model\Cart
 * @method string getId()
 * @method LineItem setId(string $id)
 * @method string getProductId()
 * @method LineItem setProductId(string $productId)
 * @method LocalizedString getName()
 * @method LineItem setName(LocalizedString $name)
 * @method ProductVariant getVariant()
 * @method LineItem setVariant(ProductVariant $variant)
 * @method Price getPrice()
 * @method LineItem setPrice(Price $price)
 * @method int getQuantity()
 * @method LineItem setQuantity(int $quantity)
 * @method array getState()
 * @method LineItem setState(array $state)
 * @method TaxRate getTaxRate()
 * @method LineItem setTaxRate(TaxRate $taxRate)
 * @method array getSupplyChannel()
 * @method LineItem setSupplyChannel(array $supplyChannel)
 * @method array getDiscountedPrice()
 * @method LineItem setDiscountedPrice(array $discountedPrice)
 */
class LineItem extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'productId' => [static::TYPE => 'string'],
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'variant' => [static::TYPE => '\Sphere\Core\Model\Product\ProductVariant'],
            'price' => [static::TYPE => '\Sphere\Core\Model\Common\Price'],
            'quantity' => [static::TYPE => 'int'],
            'state' => [static::TYPE => 'array'],
            'taxRate' => [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxRate'],
            'supplyChannel' => [static::TYPE => 'array'],
            'discountedPrice' => [static::TYPE => 'array'],
        ];
    }

    /**
     * @return Money
     */
    public function getTotal()
    {
        $price = $this->getPrice()->getValue();
        $amount = $this->getQuantity() * $price->getCentAmount();
        return new Money($price->getCurrencyCode(), $amount, $this->getContext());
    }
}
