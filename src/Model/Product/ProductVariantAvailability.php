<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://dev.commercetools.com/http-api-projects-products.html#productvariantavailability
 * @method bool getIsOnStock()
 * @method ProductVariantAvailability setIsOnStock(bool $isOnStock = null)
 * @method int getRestockableInDays()
 * @method ProductVariantAvailability setRestockableInDays(int $restockableInDays = null)
 * @method int getAvailableQuantity()
 * @method ProductVariantAvailability setAvailableQuantity(int $availableQuantity = null)
 * @method ProductVariantAvailabilityCollection getChannels()
 * @method ProductVariantAvailability setChannels(ProductVariantAvailabilityCollection $channels = null)
 */
class ProductVariantAvailability extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'isOnStock' => [static::TYPE => 'bool'],
            'restockableInDays' => [static::TYPE => 'int'],
            'availableQuantity' => [static::TYPE => 'int'],
            'channels' => [static::TYPE => '\Commercetools\Core\Model\Product\ProductVariantAvailabilityCollection'],
        ];
    }
}
