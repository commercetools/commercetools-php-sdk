<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 17:20
 */

namespace Sphere\Core\Request\Endpoints;


use Sphere\Core\Http\JsonEndpoint;

class ProductProjectionsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('products');
    }
}
