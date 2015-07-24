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
 * @package Sphere\Core\Model\Order
 * @method int getId()
 * @method ProductVariantImportDraft setId(int $id = null)
 * @method string getSku()
 * @method ProductVariantImportDraft setSku(string $sku = null)
 * @method PriceCollection getPrices()
 * @method ProductVariantImportDraft setPrices(PriceCollection $prices = null)
 * @method AttributeCollection getAttributes()
 * @method ProductVariantImportDraft setAttributes(AttributeCollection $attributes = null)
 * @method ImageCollection getImages()
 * @method ProductVariantImportDraft setImages(ImageCollection $images = null)
 */
class ProductVariantImportDraft extends JsonObject
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
