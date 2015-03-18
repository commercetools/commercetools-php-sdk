<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:41
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\Attribute;
use Sphere\Core\Model\Common\Collection;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\Price;

/**
 * Class ProductVariantDraft
 * @package Sphere\Core\Model\Product
 * @method string getSku()
 * @method Price[] getPrices()
 * @method Attribute[] getAttributes()
 * @method ProductVariantDraft setSku(string $sku = null)
 * @method ProductVariantDraft setPrices(Collection $prices = null)
 * @method ProductVariantDraft setAttributes(Collection $attributes = null)
 */
class ProductVariantDraft extends JsonObject
{
    public function getFields()
    {
        return [
            'sku' => [self::TYPE => 'string'],
            'prices' => [self::TYPE => '\Sphere\Core\Model\Common\Collection'],
            'attributes' => [self::TYPE => '\Sphere\Core\Model\Common\Collection'],
        ];
    }
}
