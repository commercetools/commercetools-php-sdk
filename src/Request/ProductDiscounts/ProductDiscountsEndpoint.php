<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductDiscounts;


use Commercetools\Core\Client\JsonEndpoint;

/**
 * @package Commercetools\Core\Request\ProductDiscounts
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
