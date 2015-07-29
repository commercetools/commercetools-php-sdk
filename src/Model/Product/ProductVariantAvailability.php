<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\JsonObject;

/**
 * @package Sphere\Core\Model\Product
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#product-variant-availability
 * @method bool getIsOnStock()
 * @method ProductVariantAvailability setIsOnStock(bool $isOnStock = null)
 * @method int getRestockableInDays()
 * @method ProductVariantAvailability setRestockableInDays(int $restockableInDays = null)
 */
class ProductVariantAvailability extends JsonObject
{
    public function getFields()
    {
        return [
            'isOnStock' => [static::TYPE => 'bool'],
            'restockableInDays' => [static::TYPE => 'int'],
        ];
    }
}
