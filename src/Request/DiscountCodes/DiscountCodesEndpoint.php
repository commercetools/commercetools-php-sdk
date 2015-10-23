<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\DiscountCodes;

use Commercetools\Core\Client\JsonEndpoint;

/**
 * @package Commercetools\Core\Request\DiscountCodes
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
