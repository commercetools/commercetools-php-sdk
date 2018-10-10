<?php
/**
 */

namespace Commercetools\Core\Request\OrderEdits;

use Commercetools\Core\Client\JsonEndpoint;

/**
 * @package Commercetools\Core\Request\OrderEdits
 */
class OrderEditsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('orders/edits');
    }
}
