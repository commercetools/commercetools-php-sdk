<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomObjects;


use Sphere\Core\Client\JsonEndpoint;

/**
 * Class CustomObjectsEndpoint
 * @package Sphere\Core\Request\CustomObjects
 */
class CustomObjectsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('custom-objects');
    }
}
