<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Product
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#product-variant-availability
 * @method bool getIsOnStock()
 * @method ProductVariantAvailability setIsOnStock(bool $isOnStock = null)
 * @method int getRestockableInDays()
 * @method ProductVariantAvailability setRestockableInDays(int $restockableInDays = null)
 */
class ProductVariantAvailability extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'isOnStock' => [static::TYPE => 'bool'],
            'restockableInDays' => [static::TYPE => 'int'],
        ];
    }
}
