<?php

namespace Commercetools\Core\Request\ProductSelections;

use Commercetools\Core\Client\JsonEndpoint;

class ProductSelectionsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('product-selections');
    }
}
