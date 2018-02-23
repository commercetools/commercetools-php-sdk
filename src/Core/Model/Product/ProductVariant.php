<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\AttributeCollection;
use Commercetools\Core\Model\Common\ImageCollection;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\PriceCollection;
use Commercetools\Core\Model\Common\Price;
use Commercetools\Core\Model\Common\ScopedPrice;
use Commercetools\Core\Model\Common\AssetCollection;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://docs.commercetools.com/http-api-projects-products.html#productvariant
 * @method int getId()
 * @method ProductVariant setId(int $id = null)
 * @method string getSku()
 * @method ProductVariant setSku(string $sku = null)
 * @method PriceCollection getPrices()
 * @method ProductVariant setPrices(PriceCollection $prices = null)
 * @method AttributeCollection getAttributes()
 * @method ProductVariant setAttributes(AttributeCollection $attributes = null)
 * @method ImageCollection getImages()
 * @method ProductVariant setImages(ImageCollection $images = null)
 * @method ProductVariantAvailability getAvailability()
 * @method ProductVariant setAvailability(ProductVariantAvailability $availability = null)
 * @method Price getPrice()
 * @method ProductVariant setPrice(Price $price = null)
 * @method bool getIsMatchingVariant()
 * @method ProductVariant setIsMatchingVariant(bool $isMatchingVariant = null)
 * @method ScopedPrice getScopedPrice()
 * @method ProductVariant setScopedPrice(ScopedPrice $scopedPrice = null)
 * @method bool getScopedPriceDiscounted()
 * @method ProductVariant setScopedPriceDiscounted(bool $scopedPriceDiscounted = null)
 * @method AssetCollection getAssets()
 * @method ProductVariant setAssets(AssetCollection $assets = null)
 * @method string getKey()
 * @method ProductVariant setKey(string $key = null)
 */
class ProductVariant extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'prices' => [static::TYPE => PriceCollection::class],
            'price' => [static::TYPE => Price::class],
            'attributes' => [static::TYPE => AttributeCollection::class],
            'images' => [static::TYPE => ImageCollection::class],
            'availability' => [static::TYPE => ProductVariantAvailability::class],
            'isMatchingVariant' => [static::TYPE => 'bool'],
            'scopedPrice' => [static::TYPE => ScopedPrice::class],
            'scopedPriceDiscounted' => [static::TYPE => 'bool'],
            'assets' => [static::TYPE => AssetCollection::class],
            'key' => [static::TYPE => 'string'],
        ];
    }
}
