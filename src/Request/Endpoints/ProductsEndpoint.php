<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 17:57
 */

namespace Sphere\Core\Request\Endpoints;


use Sphere\Core\Client\JsonEndpoint;

class ProductsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('products');
    }
}
