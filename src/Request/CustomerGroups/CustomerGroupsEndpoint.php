<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomerGroups;


use Sphere\Core\Client\JsonEndpoint;

/**
 * @package Sphere\Core\Request\CustomerGroups
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
