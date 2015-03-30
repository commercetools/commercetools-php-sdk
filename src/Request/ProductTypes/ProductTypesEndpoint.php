<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes;


use Sphere\Core\Client\JsonEndpoint;

/**
 * Class ProductTypesEndpoint
 * @package Sphere\Core\Request\ProductTypes
 */
class ProductTypesEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('product-types');
    }
}
