<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductDiscounts;


use Sphere\Core\Client\JsonEndpoint;

/**
 * Class ProductDiscountsEndpoint
 * @package Sphere\Core\Request\ProductDiscounts
 */
class ProductDiscountsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('product-discounts');
    }
}
