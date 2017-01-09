<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:41
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\AttributeCollection;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\Common\ImageCollection;
use Commercetools\Core\Model\Common\AssetDraftCollection;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://dev.commercetools.com/http-api-projects-products.html#productvariantdraft
 * @method string getSku()
 * @method ProductVariantDraft setSku(string $sku = null)
 * @method ProductVariantDraft setPrices(PriceDraftCollection $prices = null)
 * @method ProductVariantDraft setAttributes(AttributeCollection $attributes = null)
 * @method PriceDraftCollection getPrices()
 * @method AttributeCollection getAttributes()
 * @method ImageCollection getImages()
 * @method ProductVariantDraft setImages(ImageCollection $images = null)
 * @method AssetDraftCollection getAssets()
 * @method ProductVariantDraft setAssets(AssetDraftCollection $assets = null)
 */
class ProductVariantDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'sku' => [self::TYPE => 'string'],
            'prices' => [self::TYPE => PriceDraftCollection::class],
            'images' => [static::TYPE => ImageCollection::class],
            'attributes' => [self::TYPE => AttributeCollection::class],
            'assets' => [static::TYPE => AssetDraftCollection::class]
        ];
    }
}
