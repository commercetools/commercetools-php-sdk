<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:41
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\Attribute;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\Price;

/**
 * Class ProductVariantDraft
 * @package Sphere\Core\Model\Product
 * @method string getSku()
 * @method Price[] getPrices()
 * @method Attribute[] getAttributes()
 * @method ProductDraft setSku(string $sku)
 * @method ProductDraft setPrices(array $prices)
 * @method ProductDraft setAttributes(array $attributes)
 */
class ProductVariantDraft extends JsonObject
{
    public function getFields()
    {
        return [
            'sku' => [self::TYPE => 'string'],
            'prices' => [self::TYPE => 'array'],
            'attributes' => [self::TYPE => 'array'],
        ];
    }
}
