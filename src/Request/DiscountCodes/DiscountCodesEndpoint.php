<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\DiscountCodes;


use Sphere\Core\Client\JsonEndpoint;

/**
 * Class DiscountCodesEndpoint
 * @package Sphere\Core\Request\DiscountCodes
 */
class DiscountCodesEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('discount-codes');
    }
}
