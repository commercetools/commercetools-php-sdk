<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\AttributeCollection;
use Commercetools\Core\Model\Common\ImageCollection;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\PriceCollection;
use Commercetools\Core\Model\Common\Price;

/**
 * @package Commercetools\Core\Model\Product
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#product-variant
 * @method string getId()
 * @method ProductVariant setId(string $id = null)
 * @method int getSku()
 * @method ProductVariant setSku(int $sku = null)
 * @method PriceCollection getPrices()
 * @method ProductVariant setPrices(PriceCollection $prices = null)
 * @method AttributeCollection getAttributes()
 * @method ProductVariant setAttributes(AttributeCollection $attributes = null)
 * @method ImageCollection getImages()
 * @method ProductVariant setImages(ImageCollection $images = null)
 * @method LocalizedString getAvailability()
 * @method ProductVariant setAvailability(LocalizedString $availability = null)
 * @method Price getPrice()
 * @method ProductVariant setPrice(Price $price = null)
 */
class ProductVariant extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'sku' => [static::TYPE => 'int'],
            'prices' => [static::TYPE => '\Commercetools\Core\Model\Common\PriceCollection'],
            'price' => [static::TYPE => '\Commercetools\Core\Model\Common\Price'],
            'attributes' => [static::TYPE => '\Commercetools\Core\Model\Common\AttributeCollection'],
            'images' => [static::TYPE => '\Commercetools\Core\Model\Common\ImageCollection'],
            'availability' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
        ];
    }
}
