<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 17:57
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Client\JsonEndpoint;

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
