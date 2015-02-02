<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 11:27
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Http\JsonEndpoint;

/**
 * Class ProductProjectionEndpoint
 * @package Sphere\Core\Request\Products
 */
class ProductSearchEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('product-projections/search');
    }
}
