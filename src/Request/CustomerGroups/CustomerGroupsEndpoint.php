<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomerGroups;

use Commercetools\Core\Client\JsonEndpoint;

/**
 * @package Commercetools\Core\Request\CustomerGroups
 */
class CustomerGroupsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('customer-groups');
    }
}
