<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:41
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\AttributeCollection;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\PriceCollection;
use Commercetools\Core\Model\Common\ImageCollection;

/**
 * @package Commercetools\Core\Model\Product
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#new-product-variant
 * @method string getSku()
 * @method ProductVariantDraft setSku(string $sku = null)
 * @method ProductVariantDraft setPrices(PriceCollection $prices = null)
 * @method ProductVariantDraft setAttributes(AttributeCollection $attributes = null)
 * @method PriceCollection getPrices()
 * @method AttributeCollection getAttributes()
 * @method ImageCollection getImages()
 * @method ProductVariantDraft setImages(ImageCollection $images = null)
 */
class ProductVariantDraft extends JsonObject
{
    public function getPropertyDefinitions()
    {
        return [
            'sku' => [self::TYPE => 'string'],
            'prices' => [self::TYPE => '\Commercetools\Core\Model\Common\PriceCollection'],
            'images' => [static::TYPE => '\Commercetools\Core\Model\Common\ImageCollection'],
            'attributes' => [self::TYPE => '\Commercetools\Core\Model\Common\AttributeCollection'],
        ];
    }
}
