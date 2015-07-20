<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 17:20
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Client\JsonEndpoint;

class ProductProjectionEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('product-projections');
    }
}
