<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\PriceCollection;
use Sphere\Core\Model\Common\AttributeCollection;
use Sphere\Core\Model\Common\ImageCollection;

/**
 * Class ImportProductVariant
 * @package Sphere\Core\Model\Order
 * @method int getId()
 * @method ImportProductVariant setId(int $id = null)
 * @method string getSku()
 * @method ImportProductVariant setSku(string $sku = null)
 * @method PriceCollection getPrices()
 * @method ImportProductVariant setPrices(PriceCollection $prices = null)
 * @method AttributeCollection getAttributes()
 * @method ImportProductVariant setAttributes(AttributeCollection $attributes = null)
 * @method ImageCollection getImages()
 * @method ImportProductVariant setImages(ImageCollection $images = null)
 */
class ImportProductVariant extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'prices' => [static::TYPE => '\Sphere\Core\Model\Common\PriceCollection'],
            'attributes' => [static::TYPE => '\Sphere\Core\Model\Common\AttributeCollection'],
            'images' => [static::TYPE => '\Sphere\Core\Model\Common\ImageCollection'],
        ];
    }
}
