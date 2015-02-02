<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 16:44
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Http\JsonEndpoint;

class ProductSuggestEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('product-projections/suggest');
    }
}
