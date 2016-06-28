<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\PriceCollection;
use Commercetools\Core\Model\Common\AttributeCollection;
use Commercetools\Core\Model\Common\ImageCollection;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://dev.commercetools.com/http-api-projects-orders-import.html#productvariantimportdraft
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
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'prices' => [static::TYPE => '\Commercetools\Core\Model\Common\PriceCollection'],
            'attributes' => [static::TYPE => '\Commercetools\Core\Model\Common\AttributeCollection'],
            'images' => [static::TYPE => '\Commercetools\Core\Model\Common\ImageCollection'],
        ];
    }
}
