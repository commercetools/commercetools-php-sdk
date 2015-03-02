<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\Common\Price;
use Sphere\Core\Model\Product\ProductVariant;

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
        ];
    }
}
