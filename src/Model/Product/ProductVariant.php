<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\ImageCollection;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\Common\PriceCollection;

/**
 * Class ProductVariant
 * @package Sphere\Core\Model\Product
 * @method string getId()
 * @method ProductVariant setId(string $id)
 * @method int getSku()
 * @method ProductVariant setSku(int $sku)
 * @method PriceCollection getPrices()
 * @method ProductVariant setPrices(PriceCollection $prices)
 * @method array getAttributes()
 * @method ProductVariant setAttributes(array $attributes)
 * @method ImageCollection getImages()
 * @method ProductVariant setImages(ImageCollection $images)
 * @method LocalizedString getAvailability()
 * @method ProductVariant setAvailability(LocalizedString $availability)
 */
class ProductVariant extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'sku' => [static::TYPE => 'int'],
            'prices' => [static::TYPE => '\Sphere\Core\Model\Common\PriceCollection'],
            'attributes' => [static::TYPE => 'array'],
            'images' => [static::TYPE => '\Sphere\Core\Model\Common\ImageCollection'],
            'availability' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
        ];
    }
}
