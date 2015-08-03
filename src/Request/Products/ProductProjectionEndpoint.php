<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 17:20
 */

namespace Commercetools\Core\Request\Products;


use Commercetools\Core\Client\JsonEndpoint;

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
