<?php
/**
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DiscountedPrice;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-message-types.html#productpricediscountsset-message
 * @method int getVariantId()
 * @method ProductPriceDiscountsSetUpdatedPrice setVariantId(int $variantId = null)
 * @method string getVariantKey()
 * @method ProductPriceDiscountsSetUpdatedPrice setVariantKey(string $variantKey = null)
 * @method string getSku()
 * @method ProductPriceDiscountsSetUpdatedPrice setSku(string $sku = null)
 * @method string getPriceId()
 * @method ProductPriceDiscountsSetUpdatedPrice setPriceId(string $priceId = null)
 * @method DiscountedPrice getDiscounted()
 * @method ProductPriceDiscountsSetUpdatedPrice setDiscounted(DiscountedPrice $discounted = null)
 * @method bool getStaged()
 * @method ProductPriceDiscountsSetUpdatedPrice setStaged(bool $staged = null)
 */
class ProductPriceDiscountsSetUpdatedPrice extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'variantId' => [static::TYPE => 'int'],
            'variantKey' => [static::TYPE => 'string'],
            'sku' => [static::TYPE => 'string'],
            'priceId' => [static::TYPE => 'string'],
            'discounted' => [static::TYPE => DiscountedPrice::class],
            'staged' => [static::TYPE => 'bool'],
        ];
    }
}
